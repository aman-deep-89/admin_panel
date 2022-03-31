<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Role;
use App\Models\User;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Issues;
use DateTime;
class UserController extends Controller
{
    public function index()
    {
        //
        $users = User::with('user_roles')->get();
        return view('/users/index',compact('users'));  
    }

    public function create()
    {
        return view('/users/create');  
    }

    public function store(Request $request)
    {
        //
        $request->validate([  
            'first_name'=>'required',
            'last_name'=>'required',
            'initial_balance'=>'required|gte:0',
            'password'=>'nullable|required_with:password_confirmation|string|confirmed',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|alpha_num|unique:users,username',
        ]);
        //DB::enableQueryLog(); 
        $user = new User();
		$user->username = $request->get('username');
		$user->first_name = $request->get('first_name');
		$user->last_name = $request->get('last_name');
		$user->phone_number = $request->get('phone_no');
		$user->alternate_phone_number = $request->get('alternate_phone_no');
		$user->internal_data = $request->get('internal_data');
		$user->vendor = $request->get('vendor');
		$user->business_type = $request->get('business_type');
		$user->email = $request->get('email');
		$user->initial_balance = $request->get('initial_balance');
		$user->current_balance = $request->get('initial_balance');
		$user->password = bcrypt($request->get('password'));
        if(!empty($request->post('logo')))
            $user->profile_img=$request->get('logo');
		$user->save();
        if($user->id) {
            $user_role = Role::wherein('name',['User'])->get();
            $user->roles()->attach($user_role);
            $mailData = [
                'title' => 'Account Detail',
                'subject'=>'Account Details',
                'username' => $request->get('username'),
                'password'=>$request->get('password'),
                'name'=>$request->get('first_name').' '.$request->get('last_name')
            ];
             
            Mail::to($request->get('email'))->send(new MyTestMail($mailData));
            return redirect()->route('user.index') ->with('success', 'User created successfully.');
        } else {
            return redirect()->route('user.index') ->with('error', 'There is an error');
        }        
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
        $user= User::find($id);  
        return view('users/edit', compact('user'));  
    }

   public function update(Request $request, $id)
    {
        $user = User::find($id);  
        $request->validate([  
            'username'=>'required',
            'first_name'=>'required',
            'last_name'=>'required',
            'password'=>'nullable|required_with:password_confirmation|string|confirmed',
            'email' => 'required|email|unique:users,email,'.$user->id.',id',
            'username' => 'required|alpha_num|unique:users,username,'.$user->id.',id',
        ]);
        
        $user->username = $request->get('username');
        $user->first_name = $request->get('first_name');
		$user->last_name = $request->get('last_name');
		$user->phone_number = $request->get('phone_no');        
		$user->alternate_phone_number = $request->get('alternate_phone_no');
		$user->internal_data = $request->get('internal_data');
		$user->vendor = $request->get('vendor');
        $user->initial_balance = $request->get('initial_balance');		
		$user->business_type = $request->get('business_type');
		if(!empty($request->post('logo')))
            $user->profile_img=$request->get('logo');
		$user->email = $request->get('email');
        if($request->get('password')!=null) {
            $user->password = bcrypt($request->get('password'));
        }
        if(!empty($request->post('logo')))
            $user->profile_img=$request->get('logo');		
        $user->save();             
        return redirect()->route('user.index') ->with('success', 'User detail saved successfully.'); }

    public function destroy($id)
    {
        $user=User::find($id);
        $user->delete();
        //dd(DB::getQueryLog());  exit;
        return redirect()->route('user.index') ->with('success', 'User deleted successfully.');       
    }
    public function add_balance() {
        $users=User::select( DB::raw("CONCAT(first_name,' ',last_name) AS full_name"),'id')->where('username','!=','admin')->pluck('full_name', 'id');        
        return view('users/add_balance',['users'=>$users]);
    }
    public function save_balance(Request $request)
    {
        //
        $request->validate([  
            'user_id'=>'required',
            'balance_amount'=>'required|gte:1',
            'date'=>'required',
        ]);
        //DB::enableQueryLog(); 
        $user = new User();
        $dt1=DateTime::createFromFormat('d/m/Y',$request->post('date'));
        $dt=$dt1->format('Y-m-d');        
        $user_id=$request->post('user_id');
        $flag=DB::table('balance_history')->insert(['user_id'=>$user_id,'amount'=>$request->post('balance_amount'),'date'=>$dt,'created_by'=>auth()->user()->id,'bh_status'=>'approved','bh_read'=>0]);
        $user=User::find($user_id);
        $user->current_balance=$user->current_balance+$request->post('balance_amount');
        $user->save();
		if($flag) {
            return redirect()->to(url('user/balance_history')) ->with('success', 'Balance Added successfully.');
        } else {
            return redirect()->back()->with('error', 'There is an error');
        }        
    }
    public function balance_history() {
        $res=DB::table('balance_history')->join('users','users.id','balance_history.user_id')->select("*")->get();
        return view('users/balance_history',['list'=>$res]);
    }
    public function edit_balance($id) {
        $users=User::select( DB::raw("CONCAT(first_name,' ',last_name) AS full_name"),'id')->where('username','!=','admin')->pluck('full_name', 'id'); 
        $res=DB::table('balance_history')->where('created_by','=',auth()->user()->id)->where('bh_id','=',$id)->first();
        return view('users/edit_balance',['list'=>$res,'users'=>$users]);
    }
    public function update_balance(Request $request)
    {
        //
        $request->validate([  
            'user_id'=>'required',
            'balance_amount'=>'required|gte:1',
            'date'=>'required',
        ]);
        //DB::enableQueryLog(); 
        $dt1=DateTime::createFromFormat('d/m/Y',$request->post('date'));
        $dt=$dt1->format('Y-m-d');        
        $user_id=$request->post('user_id');
        $id=$request->post('bh_id');
        $res=DB::table('balance_history')->where('created_by','=',auth()->user()->id)->where('bh_id','=',$id)->first();

        $flag=DB::table('balance_history')->where('created_by','=',auth()->user()->id)->where('bh_id','=',$id)->update(['user_id'=>$user_id,'amount'=>$request->post('balance_amount'),'bh_description'=>$request->post('description'),'date'=>$dt,'created_by'=>auth()->user()->id]);

        $user=User::find($res->user_id);
        $user->current_balance=$user->current_balance-$res->amount;
        $user->save();
        $user=User::find($user_id);
        $user->current_balance=$user->current_balance+$request->post('balance_amount');
        $user->save();

		if($flag) {
            return redirect()->to(url('user/balance_history')) ->with('success', 'Balance Added successfully.');
        } else {
            return redirect()->back()->with('error', 'There is an error');
        }        
    }
    public function check_username(Request $request) {
        $username=$request->post('name');
        $id=$request->post('id');
        if($id>0)
            $user=User::find($id)->where('username','=',$username)->first();
        else $user=User::where('username','=',$username)->first();
        $data=[];
        if($user) $data['error']=$username.' already exists';
        else $data['success']=true;
        echo json_encode($data);
        exit;
    }
    public function balance_requests() {
        $res=DB::table('balance_history')->join('users','users.id','balance_history.user_id')->where('created_by','!=',auth()->user()->id)->select("*")->get();
        return view('users/balance_requests',['list'=>$res]);
    }
    public function accept_request(Request $request) {
        $request->validate([  
            'request_id'=>'required',
            'amount'=>'required|gte:1',
        ]);
        //DB::enableQueryLog(); 
        $id=$request->post('request_id');
        $flag=DB::table('balance_history')->where('bh_id','=',$id)->update(['amount'=>$request->post('amount'),'bh_description2'=>$request->post('description'),'bh_status'=>'approved']);

        $res=DB::table('balance_history')->where('bh_id','=',$id)->first();

        $user=User::find($res->user_id);
        $user->current_balance=$user->current_balance+$request->post('amount');
        $user->save();        

		if($flag) {
            return redirect()->to(url('user/balance_requests')) ->with('success', 'Balance updated successfully.');
        } else {
            return redirect()->back()->with('error', 'There is an error');
        }
    }
    public function reject_request(Request $request) {
        $request->validate([  
            'request_id'=>'required',
        ]);
        //DB::enableQueryLog(); 
        $id=$request->post('request_id');
        $flag=DB::table('balance_history')->where('bh_id','=',$id)->update(['amount'=>0,'bh_description2'=>$request->post('description'),'bh_status'=>'rejected']);                    

		if($flag) {
            return redirect()->to(url('user/balance_requests')) ->with('error', 'Rquest Rejected.');
        } else {
            return redirect()->back()->with('error', 'There is an error');
        }
    }
    public function open_account_request(Request $request,$id) {
        $detail=Purchase::find($id);
        $detail->p_read=1;
        $detail->save();
        return view('users/open_account_request',['detail'=>$detail]);
    }
    public function purchase_requests() {
        $list=Purchase::with('users')->where('p_status','=','pending')->get(); 
        return view('users/purchase_requests',['list'=>$list]);
    }
    public function pending_requests() {
        $list=PurchaseDetail::with('purchases')->where('pd_status','=','pending')->get(); 
        return view('users/pending_requests',['list'=>$list]);
    }
    public function save_accounts(Request $request) {
        $validator = Validator::make($request->all(), [
            'detail.*.username' => 'required_if:detail.*.status,accept',
            'detail.*.start_date' => 'required_if:detail.*.status,accept',
            'detail.*.end_date' => 'required_if:detail.*.status,accept',
        ],[
            'detail.*.username.required_if' => 'Please enter username',
            'detail.*.start_date.required_if' => "Please enter start date",
            'detail.*.end_date.required_if' => "Please enter end date",
        ]);
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        } 
        $detail=$request->post('detail');
        $purchase_id=0;
        $total=sizeof($detail);
        $processed=0;
        foreach($detail as $val) {
            if($val['status']!='nothing') {
                $processed++;
                $pd=PurchaseDetail::find($val['pd_id']);
                $purchase_id=$pd->purchase_id;
                if($val['status']=='accept') {
                    $pd->pd_username=$val['username'];
                    $pd->pd_password=$val['password'];
                    $pd->pd_cost=$val['cost'];
                    $dt1=DateTime::createFromFormat('d/m/Y',$val['start_date']);
                    $dt=$dt1->format('Y-m-d');  
                    $pd->pd_start_date=$dt;
                    $dt1=DateTime::createFromFormat('d/m/Y',$val['end_date']);
                    $dt=$dt1->format('Y-m-d');  
                    $pd->pd_end_date=$dt;
                    $pd->pd_status='accepted';
                    $pd->pd_read=0;
                } if($val['status']=='reject') {
                    if($pd->pd_status!='rejected') {
                        $user=User::find($pd->purchases->user_id);
                        $user->current_balance=$user->current_balance+$pd->pd_price;
                        $user->save();
                    }
                    $pd->pd_status='rejected';
                    $pd->pd_read=0;                    
                }
                $pd->save();
            }
        } 
        $total=PurchaseDetail::where('purchase_id','=',$purchase_id)->count();
        $processed=PurchaseDetail::where('pd_status','!=','pending')->where('purchase_id','=',$purchase_id)->count();
        if($processed==$total) {
            $purchase=Purchase::find($purchase_id);
            $purchase->p_status='completed';
            $purchase->save();
        } 
        $request->session()->flash('success', 'User account detail is successfully updated');
        return response()->json(['success'=>true]); 
    }
    public function open_balance_request(Request $request,$id) {
        $res=DB::table('balance_history')->join('users','users.id','balance_history.user_id')->where('created_by','!=',auth()->user()->id)->where('bh_id','=',$id)->select("*")->first();
        return view('users/balance_request_detail',['list'=>$res]);
    }
    public function open_issue(Request $request,$id) {
        if(auth()->user()->hasRole('admin'))
        $issue=Issues::with('purchase_detail')->find($id);
        else $issue=Issues::with('purchase_detail')->where('user_id','=',auth()->user()->id)->find($id);
        $issue->issue_read=1;
        $issue->save();
        return view('users/open_issue',['detail'=>$issue]);
    }
    public function update_issue_status(Request $request) {
        $id=$request->post('issue_id');
        $status=$request->post('status');
        $description=$request->post('description');
        $issue=Issues::find($id);
        $issue->issue_status=$status;
        $issue->issue_read=0;
        $issue->status_description=$description;
        $issue->save();
        $pd=PurchaseDetail::find($issue->pd_id);
        $pd->issue_reported=0;
        $pd->save();
        return redirect()->to(url('view_issues')) ->with('success', 'Issue status updated successfully.');       
    }
    public function view_issues() {
        if(auth()->user()->hasRole('admin'))
            $issues=Issues::with('purchase_detail')->get();
        else 
            $issues=Issues::with('purchase_detail')->where('user_id','=',auth()->user()->id)->get();
        return view('users/view_issues',['list'=>$issues]);
    }
}