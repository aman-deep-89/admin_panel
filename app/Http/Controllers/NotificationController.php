<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Notifications;
use App\Models\User;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notification=Notifications::all();
        return view('notifications/index',['list'=>$notification]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users=User::select( DB::raw("CONCAT(first_name,' ',last_name) AS full_name"),'id')->where('username','!=','admin')->pluck('full_name', 'id'); 
        return view('notifications/create',['users'=>$users]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([  
            'title'=>'required',
        ]);
        //DB::enableQueryLog(); 
        $notification = new Notifications();
		$notification->notification_title = $request->get('title');
		$notification->notification_text = $request->get('description');
		$notification->n_enable = $request->get('active');
		$notification->user_id = is_array($request->get('user_id')) ? implode(',',$request->get('user_id')) : null; 
        $notification->save();
        if($notification->notification_id) {
            return redirect()->route('notification.index') ->with('success', 'Notification created successfully.');
        } else {
            return redirect()->route('notification.index') ->with('error', 'There is an error');
        }        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $notification=Notifications::find($id);
        $users=User::select( DB::raw("CONCAT(first_name,' ',last_name) AS full_name"),'id')->where('username','!=','admin')->pluck('full_name', 'id'); 
        return view('notifications/edit',['users'=>$users,'notification'=>$notification]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([  
            'title'=>'required',
        ]);
        //DB::enableQueryLog(); 
        $notification = Notifications::find($id);
		$notification->notification_title = $request->get('title');
		$notification->notification_text = $request->get('description');
		$notification->n_enable = $request->get('active');
		$notification->user_id = is_array($request->get('user_id')) ? implode(',',$request->get('user_id')) : null; 
        $notification->save();
        if($notification->notification_id) {
            return redirect()->route('notification.index') ->with('success', 'Notification updated successfully.');
        } else {
            return redirect()->route('notification.index') ->with('error', 'There is an error');
        }   
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $notification = Notifications::find($id);
        $notification->delete();
        return redirect()->route('notification.index') ->with('success', 'Notification deleted successfully.');
    }
}
