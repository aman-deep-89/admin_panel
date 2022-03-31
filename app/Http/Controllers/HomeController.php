<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Notifications;
use App\Models\Issues;
use DateTime;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(auth()->user()->hasRole('admin')) {        
        $users=User::where('username','!=','admin')->count();
        $products=Product::count();
        $accounts=PurchaseDetail::where('pd_status','=','accepted')->count();
        $income=PurchaseDetail::where('pd_status','=','accepted')->select(DB::raw('SUM(pd_cost) AS total'))->first();
        $income_month=PurchaseDetail::where('pd_status','=','accepted')->whereRaw('MONTH(pd_creation_date)='.date('m'))->whereRaw('YEAR(pd_creation_date)='.date('Y'))->select(DB::raw('SUM(pd_cost) AS total'))->first();
        $pending_purchase=Purchase::with('users')->where('p_status','=','pending')->orderBy('p_creation_date','DESC')->limit(5)->get();
        $pending_balance=DB::select( DB::Raw('SELECT *,DATE_FORMAT(bh_created_at,"%d-%M-%Y %h:%i %p") as create_dt FROM balance_history JOIN users ON users.id=balance_history.user_id WHERE bh_status="pending" ORDER BY bh_created_at DESC LIMIT 10'));
        $account_chart=DB::select( DB::Raw('SELECT *,SUM(IF(pd_status="accepted",1,0)) AS accepted,SUM(IF(pd_status="rejected",1,0)) AS rejected,SUM(pd_quantity) AS total_qty,YEAR(pd_creation_date) AS yr,MONTH(pd_creation_date) AS mon,MONTHNAME(pd_creation_date) AS mon_name FROM purchase_details GROUP BY yr,mon ORDER BY yr,mon LIMIT 10'));
        $user_chart=DB::select( DB::Raw('SELECT *,SUM(IF(pd_status="accepted",1,0)) AS accepted,SUM(IF(pd_status="rejected",1,0)) AS rejected,SUM(pd_quantity) AS total_qty,YEAR(pd_creation_date) AS yr,MONTH(pd_creation_date) AS mon,MONTHNAME(pd_creation_date) AS mon_name FROM purchase_details JOIN purchases USING(purchase_id) JOIN users ON users.id=purchases.user_id GROUP BY yr,mon,user_id ORDER BY yr,mon LIMIT 10'));
        $total_balance = DB::table('users') ->selectRaw('sum(current_balance) AS total') ->first();
        $highest_balance = DB::table('users') ->selectRaw('*,sum(current_balance) AS balance')->groupBy('id')->orderBy('balance','DESC')->first();
        return view('pages/dashboard-analytics',['users'=>$users,'products'=>$products,'active_accounts'=>$accounts,'income'=>$income,'monthly_income'=>$income_month,'pending_purchase'=>$pending_purchase,'pending_balance'=>$pending_balance,'account_chart'=>$account_chart,'user_chart'=>$user_chart,'total_balance'=>$total_balance,'highest_balance'=>$highest_balance]);
        }
        else {   
            $user_id=auth()->user()->id;     
        $pending_purchase=Purchase::with('users')->where('p_status','=','pending')->where('user_id','=',$user_id)->orderBy('p_creation_date','DESC')->limit(5)->get();
        $pending_balance=DB::select( DB::Raw('SELECT *,DATE_FORMAT(bh_created_at,"%d-%M-%Y %h:%i %p") as create_dt FROM balance_history JOIN users ON users.id=balance_history.user_id WHERE bh_status="pending" AND user_id="'.$user_id.'" ORDER BY bh_created_at DESC LIMIT 10'));
        $account_chart=DB::select( DB::Raw('SELECT *,SUM(IF(pd_status="accepted",1,0)) AS accepted,SUM(IF(pd_status="rejected",1,0)) AS rejected,SUM(pd_quantity) AS total_qty,YEAR(pd_creation_date) AS yr,MONTH(pd_creation_date) AS mon,MONTHNAME(pd_creation_date) AS mon_name FROM purchase_details JOIN purchases USING(purchase_id) WHERE user_id="'.$user_id.'" GROUP BY yr,mon ORDER BY yr,mon LIMIT 10'));
        $user_chart=DB::select( DB::Raw('SELECT *,SUM(IF(pd_status="accepted",1,0)) AS accepted,SUM(IF(pd_status="rejected",1,0)) AS rejected,SUM(pd_quantity) AS total_qty,YEAR(pd_creation_date) AS yr,MONTH(pd_creation_date) AS mon,MONTHNAME(pd_creation_date) AS mon_name FROM purchase_details JOIN purchases USING(purchase_id) JOIN users ON users.id=purchases.user_id WHERE user_id="'.$user_id.'" GROUP BY yr,mon,user_id ORDER BY yr,mon LIMIT 10'));
        $expiring_accounts=DB::select( DB::Raw('SELECT *,DATEDIFF(pd_end_date,CURDATE()) AS remaining_days,DATE_FORMAT(pd_end_date,"%d-%M-%Y") as end_date FROM purchase_details JOIN purchases USING(purchase_id) JOIN users ON users.id=purchases.user_id JOIN products ON products.id=purchases.product_id WHERE user_id="'.$user_id.'" AND DATEDIFF(pd_end_date,CURDATE())<=10'));
        $income=PurchaseDetail::with(['purchases'=>function($query) use ($user_id) {
            return $query->join('users','users.id','purchases.user_id')->where('user_id','=',$user_id);
        }])->where('pd_status','=','accepted')->select(DB::raw('SUM(pd_price) AS total'))->first();
        $income_month=PurchaseDetail::with(['purchases'=>function($query) use ($user_id) {
            return $query->join('users','users.id','purchases.user_id')->where('user_id','=',$user_id);
        }])->where('pd_status','=','accepted')->whereRaw('MONTH(pd_creation_date)='.date('m'))->whereRaw('YEAR(pd_creation_date)='.date('Y'))->select(DB::raw('SUM(pd_price) AS total'))->first();        
        return view('pages/dashboard-analytics',['pending_purchase'=>$pending_purchase,'pending_balance'=>$pending_balance,'account_chart'=>$account_chart,'user_chart'=>$user_chart,'expiring_accounts'=>$expiring_accounts,'income'=>$income,'monthly_income'=>$income_month]);
        }        
    }
    public function view_products() {
        $products=Product::where('p_enable','=',1)->get();
        return view('frontend/view_products',['products'=>$products]);
    }
    public function show_product($id) {
        $product=Product::find($id);
        return view('frontend/product_detail',['product'=>$product]);
    }
    public function add_balance() {
        return view('frontend/add_balance');
    }
    public function save_balance(Request $request) {
        $request->validate([  
            'balance_amount'=>'required|gte:1',
            'date'=>'required',
        ]);
        //DB::enableQueryLog(); 
        $dt1=DateTime::createFromFormat('d/m/Y',$request->post('date'));
        $dt=$dt1->format('Y-m-d');        
        $user_id=Auth::user()->id;
        $flag=DB::table('balance_history')->insert(['user_id'=>$user_id,'amount'=>0,'requested_amount'=>$request->post('balance_amount'),'date'=>$dt,'created_by'=>auth()->user()->id,'bh_status'=>'pending','bh_description'=>$request->post('description'),'bh_images'=>$request->post('filenames')]);        
		if($flag) {
            return redirect()->to(url('balance/view_request')) ->with('success', 'Balance Added successfully.');
        } else {
            return redirect()->back()->with('error', 'There is an error');
        }
    }
    public function edit_balance($id) {
        $res=DB::table('balance_history')->where('created_by','=',auth()->user()->id)->where('bh_id','=',$id)->first();
        return view('frontend/edit_balance',['list'=>$res]);
    }
    public function update_balance(Request $request) {
        $request->validate([  
            'balance_amount'=>'required|gte:1',
            'request_id'=>'required',
            'date'=>'required',
        ]);
        //DB::enableQueryLog(); 
        $dt1=DateTime::createFromFormat('d/m/Y',$request->post('date'));
        $dt=$dt1->format('Y-m-d');        
        $user_id=Auth::user()->id;
        $bh_id=$request->post('request_id');
        $flag=DB::table('balance_history')->where('user_id','=',$user_id)->where('bh_id','=',$bh_id)->update(['requested_amount'=>$request->post('balance_amount'),'date'=>$dt,'bh_description'=>$request->post('description'),'bh_images'=>$request->post('filenames')]);        
		if($flag) {
            return redirect()->to(url('balance/view_request')) ->with('success', 'Balance Added successfully.');
        } else {
            return redirect()->back()->with('error', 'There is an error');
        }
    }
    public function view_balance_requests() {
        $res=DB::table('balance_history')->where('created_by','=',Auth::user()->id)->select("*")->get();
        return view('frontend/balance_history',['list'=>$res]);
    } 
    public function delete_balance(Request $request,$id) {
        $request->validate([  
            'request_id'=>'required',
        ]);
        //DB::enableQueryLog(); 
        $id=$request->post('request_id');
        $flag=DB::table('balance_history')->where('bh_id','=',$id)->where('created_by','=',auth()->user()->id)->delete();            

		if($flag) {
            return redirect()->to(url('balance/view_request')) ->with('error', 'Rquest deleted.');
        } else {
            return redirect()->back()->with('error', 'There is an error');
        }
    }   
    public function buy_product(Request $request) {
        $validator = Validator::make($request->all(), [
            'id' => 'required|gte:1',
            'quantity' => 'required|gte:1',
        ]);
        
        if ($validator->fails())
        {
            return response()->json(['errors'=>$validator->errors()->all()]);
        }   
        $pd_id=$request->post('id');
        $user_id=auth()->user()->id;            
        $quantity=$request->post('quantity');
        $product=Product::find($pd_id);
        if($product->price>auth()->user()->current_balance)
            return response()->json(['errors'=>array('Your balance is not sufficient to buy this product')]);
        if($product->out_of_stock)
                return response()->json(['errors'=>array('This product is out of stock')]);
        $purchase=new Purchase();
        $purchase->user_id=$user_id;
        $purchase->product_id=$pd_id;        
        $purchase->p_read=0;        
        $purchase->p_status='pending';        
        $purchase->quantity=$quantity;
        $purchase->total_price=$quantity*$product->price;
        $purchase->save();
        $purchase_detail=[];
        for($i=0;$i<$quantity;$i++) {
            $purchase_detail[]=new PurchaseDetail(array('pd_quantity'=>1,'pd_price'=>$product->price, 'pd_status'=>"pending", 'pd_read'=>0));
        }
        $user=User::find($user_id);
        $user->current_balance=$user->current_balance-$purchase->total_price;
        $user->save();
        $product->total_sales=$product->total_sales+$quantity;
        $product->closing_stock=$product->closing_stock-$quantity;
        $product->save();
        $purchase->purchase_detail()->saveMany($purchase_detail);
        return response()->json(['success'=>true]);
    }
    public function view_purchases() {
        $purchases=Purchase::where('user_id',auth()->user()->id)->orderBy('purchase_id','DESC')->get();
        return view('frontend/purchase_history',['list'=>$purchases]);
    }
    public function check_notification() {
        //echo "SELECT *FROM purchase_details JOIN purchases USING(purchase_id) WHERE user_id='".auth()->user()->id."' AND pd_status IN('accepted','rejected') AND pd_read=0 AND TIMESTAMPDIFF(MINUTE,pd_updated_date,'".date('Y-m-d H:i:s')."') < 100 ";
        $notifications=DB::select( DB::raw("SELECT *FROM purchase_details JOIN purchases USING(purchase_id) JOIN products ON products.id=purchases.product_id WHERE user_id='".auth()->user()->id."' AND pd_status IN('accepted','rejected') AND pd_read=0 AND TIMESTAMPDIFF(SECOND,pd_updated_date,'".date('Y-m-d H:i:s')."') < 120 "));
        return response()->json(['success'=>true,'notifications'=>$notifications]);
    }
    public function view_notifications() {
        //$notifications=Notifications::whereRaw('JSON_CONTAINS(user_id,'.auth()->user()->id.')>0 OR user_id IS NULL')->get();
        $notifications=Notifications::whereRaw('FIND_IN_SET('.auth()->user()->id.',user_id)>0 OR user_id IS NULL')->get();
        return view('frontend/notifications',['notifications'=>$notifications]);
    }
    public function read_all_notifications() {
        /*$notifications=PurchaseDetail::with(['purchases'=>function($query){
            return $query->join('users','users.id','purchases.user_id')->join('products','products.id','purchases.product_id')->where('user_id','=',Auth::user()->id);
        }])->selectRaw('*,DATE_FORMAT(pd_start_date,"%d/%m/%Y") AS start_date,DATE_FORMAT(pd_end_date,"%d/%m/%Y") AS end_date,DATEDIFF(pd_end_date,CURDATE()) AS diff')->whereIn('pd_status',['accepted','rejected'])->where('pd_read','=',0)->get();   */
        $notifications=DB::select( DB::raw("SELECT *,DATE_FORMAT(pd_start_date,'%d/%m/%Y') AS start_date,DATE_FORMAT(pd_end_date,'%d/%m/%Y') AS end_date,DATEDIFF(pd_end_date,CURDATE()) AS diff FROM purchase_details JOIN purchases USING(purchase_id) JOIN users ON users.id=purchases.user_id JOIN products ON  products.id=purchases.product_id WHERE user_id='".Auth::user()->id."' AND pd_status IN('accepted','rejected') AND pd_read=0"));
        return view('frontend/purchase_notifications',['list'=>$notifications]);  
    }
    public function open_purchase_account(Request $request,$id) {
        $detail=Purchase::find($id);
        $detail2=PurchaseDetail::where('purchase_id','=',$id)->whereIn('pd_status',['accepted','rejected'])->update(['pd_read'=>1,'pd_updated'=>0]);
        return view('frontend/open_purchase_account',['detail'=>$detail]);
    }
    public function report_issue(Request $request) {
        $pd_id=$request->post('pd_id');
        $report=$request->post('report');
        $issues=new Issues();
        $issues->pd_id=$pd_id;
        $issues->user_id=auth()->user()->id;
        $issues->detail=$report;
        $issues->issue_read=0;
        $issues->issue_status='pending';
        $issues->save();
        $pd=PurchaseDetail::find($pd_id);
        $pd->issue_reported=1;
        $pd->pd_read=0;
        $pd->save();
        return redirect()->to(url('report/purchase_report'))->with('success', 'Issue reported successfully');
    }    
}