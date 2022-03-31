<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use DateTime;
class ReportController extends Controller
{
    public function purchase_report() {
        $users=User::where('username','!=','admin')->pluck('username','id');
        return view('report/purchase_report',['users'=>$users]);
    }
    public function show_purchase_report(Request $request) {
        $users=User::where('username','!=','admin')->pluck('username','id');
        $start_date=$request->input('start_date');
        $end_date=$request->input('end_date');
        $user_id=$request->input('user_id');
        return view('report/show_purchase_report',['users'=>$users,'start_date'=>$start_date,'end_date'=>$end_date,'user_id'=>$user_id]);
    }
    public function get_purchase_report(Request $request) {
        $start_date=$request->input('start_date');
        $end_date=$request->input('end_date');
        $user_id=$request->input('user_id');
        if(auth()->user()->hasRole('user'))
            $user_id=auth()->user()->id;
        $draw = $request->get('draw');
        $start = $request->get("start");
        $rowperpage = $request->get("length"); // Rows display per page
        //$rowperpage = 1;

        $columnIndex_arr = $request->get('order');
        $columnName_arr = $request->get('columns');
        $order_arr = $request->get('order');
        $search_arr = $request->get('search');

        $columnIndex = $columnIndex_arr[0]['column']; // Column index
        $columnName = $columnName_arr[$columnIndex]['data']; // Column name
        $columnSortOrder = $order_arr[0]['dir']; // asc or desc
        $searchValue = $search_arr['value']; // Search value

        // Total records
        if($user_id)  {                  
            $totalRecords = PurchaseDetail::with(['purchases'=>function($query) use ($user_id) {
                return $query->join('users','users.id','purchases.user_id')->where('user_id','=',$user_id);
            }])->where('pd_status','!=','rejected')->select('count(*) as allcount')->count();
            $totalRecordswithFilter = PurchaseDetail::with(['purchases'=>function($query) use ($user_id) {
                return $query->join('users','users.id','purchases.user_id')->where('user_id','=',$user_id);
            }])->where('pd_status','!=','rejected')->select('count(*) as allcount')->count(); 
            $res = PurchaseDetail::with(['purchases'=>function($query) use ($user_id) {
                return $query->join('users','users.id','purchases.user_id')->where('user_id','=',$user_id);
            }])->where('pd_status','!=','rejected')->selectRaw('*,DATE_FORMAT(pd_creation_date,"%d-%M-%Y %h:%i %p") AS c_date,DATEDIFF(pd_end_date,CURDATE()) AS remaining_days')
            ->skip($start)
            ->take($rowperpage);
            if($start_date) {
                $dt1=DateTime::createFromFormat('d/m/Y',$start_date);
                $s_dt=$dt1->format('Y-m-d');  
                $totalRecordswithFilter = PurchaseDetail::with(['purchases'=>function($query) use ($user_id) {
                    return $query->join('users','users.id','purchases.user_id')->where('user_id','=',$user_id);
                }])->where('pd_status','!=','rejected')->select('count(*) as allcount')->where('pd_start_date','>=',$s_dt)->count();
                $res->where('pd_start_date','>=',$s_dt);
            }
            if($end_date) {
                $dt1=DateTime::createFromFormat('d/m/Y',$end_date);
                $e_dt=$dt1->format('Y-m-d');
                $totalRecordswithFilter = PurchaseDetail::with(['purchases'=>function($query) use ($user_id) {
                    return $query->join('users','users.id','purchases.user_id')->where('user_id','=',$user_id);
                }])->where('pd_status','!=','rejected')->select('count(*) as allcount')->where('pd_end_date','<=',$e_dt)->count();
                $res->where('pd_end_date','<=',$e_dt);
            }
        }
        else {
            $totalRecords = PurchaseDetail::select('count(*) as allcount')->count();
            $totalRecordswithFilter = PurchaseDetail::select('count(*) as allcount')->count();      
            $res = PurchaseDetail::with('purchases')->selectRaw('*,DATE_FORMAT(pd_creation_date,"%d-%M-%Y %h:%i %p") AS c_date,DATEDIFF(pd_end_date,CURDATE()) AS remaining_days')->skip($start)->take($rowperpage);
            if($start_date) {
                $dt1=DateTime::createFromFormat('d/m/Y',$start_date);
                $s_dt=$dt1->format('Y-m-d');  
                $totalRecordswithFilter = PurchaseDetail::select('count(*) as allcount')->where('pd_start_date','>=',$s_dt)->count();
                $res->where('pd_start_date','>=',$s_dt);
            }
            if($end_date) {
                $dt1=DateTime::createFromFormat('d/m/Y',$end_date);
                $e_dt=$dt1->format('Y-m-d');
                $totalRecordswithFilter = PurchaseDetail::select('count(*) as allcount')->where('pd_end_date','<=',$e_dt)->count();
                $res->where('pd_end_date','<=',$e_dt);
            }
        }        
        
        //$totalRecordswithFilter = 2;

        // Fetch records
        $records=$res->get();
        //dd(DB::getQueryLog());
        $data_arr = array();
        
        foreach($records as $record){
            if($record->purchases) {
            $id = $record->purchases->users->username.'<br/><small>'.$record->c_date.'</small>';
            $name = $record->purchases->products->name;
            $username = $record->pd_username;
            $password = $record->pd_password;
            $start_date = $record->pd_start_date;
            $end_date = $record->pd_end_date;
            $remaining_days = ($record->remaining_days)<0 ? 'expired' : $record->remaining_days;
            $note = $record->pd_status;
            $edit='';
            if($note=='accepted') $edit='<a href="'.url('purchase/modify_detail/'.$record->pd_id).'" class="btn btn-primary btn-sm">Modify</a>';
            if(auth()->user()->hasRole('admin'))
                $action = $edit.' <a href="#" class="delete btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteModal" data-id="'.$record->pd_id.'">Delete</a>';
            else if($record->issue_reported==0) 
                $action='<a href="'.url('open_purchase_account/'.$record->purchases->purchase_id).'" class="btn btn-sm btn-primary">Open</a> <a href="#" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#reportModal" data-id="'.$record->pd_id.'">Report</a>';
            else $action='';
            $class_name='';
            if($note=='rejected') $class_name='danger';
            else if($note=='accepted') $class_name='success';
            else if($note=='pending') $class_name='info';
            $data_arr[] = array(
            "pd_id" => $id,
            "name" => $name,
            "username" => $username,
            "password" => $password,
            "start_date" => $start_date,
            "end_date" => $end_date,
            "remaining_days" => $remaining_days,
            "note" => '<span class="badge badge-'.$class_name.'">'.$note.'</span>',
            "action" => $action,
            "DT_RowClass" => ($record->pd_updated) ? 'bg-success bg-light' : ''
            );
        }
        }

        $response = array(
            "draw" => intval($draw),
            "iTotalRecords" => $totalRecords,
            "iTotalDisplayRecords" => $totalRecordswithFilter,
            "aaData" => $data_arr
        );

        echo json_encode($response);
        exit;
    }
    public function delete_record(Request $request) {
        $pd_id=$request->post('id');
        $pd=PurchaseDetail::find($pd_id);
        $purchase=Purchase::find($pd->purchase_id);
        if($pd->pd_status=='rejected') {
            $purchase->total_price-=$pd->pd_price;
            $purchase->quantity-=$pd->pd_quantity;
            $purchase->save();           
        } else if($pd->pd_status=='pending' || $pd->pd_status=='accepted') {
            $user=User::find($purchase->user_id);
            $user->current_balance+=$pd->pd_price;
            $user->save();
            $product=Product::find($purchase->product_id);
            $product->closing_stock+=1;
            $product->total_sales-=1;
            $product->save();
        }
        $pd->delete();
        return redirect()->to(url('report/purchase_report'))->with('success', 'Record deleted successfully');
    }
    public function modify_detail(Request $request,$id) {
        $purchase_detail=PurchaseDetail::selectRaw('*,DATEDIFF(pd_end_date,CURDATE()) AS diff')->where('pd_status','=','accepted')->find($id);
        if($purchase_detail)
            return view('users/modify_purchase_detail',['detail'=>$purchase_detail]);
        else return view('users/no_record');
    }
    public function update_purchase_request(Request $request) {
        $pd_id=$request->post('pd_id');
        $purchase_detail=PurchaseDetail::find($pd_id);
        $purchase_detail->pd_username=$request->post('username');
        $purchase_detail->pd_password=$request->post('password');
        $dt1=DateTime::createFromFormat('d/m/Y',$request->post('start_date'));
        $dt=$dt1->format('Y-m-d');  
        $purchase_detail->pd_start_date=$dt;
        $dt1=DateTime::createFromFormat('d/m/Y',$request->post('end_date'));
        $dt=$dt1->format('Y-m-d');  
        $purchase_detail->pd_end_date=$dt;
        $purchase_detail->pd_updated=1;
        $purchase_detail->pd_read=0;
        $purchase_detail->save();
        return redirect()->to(url('report/purchase_report'))->with('success', 'Record updated successfully');
    }
}