<?php

use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::get('/', function () {
    return Redirect::to('/home');
});

Auth::routes();
Route::group(['middleware' => ['auth']], function () {
    Route::post('upload_file',[App\Http\Controllers\ImageUploadController::class,'upload_file']);
    Route::post('upload_image',[App\Http\Controllers\ImageController::class,'upload_image']);
    Route::post('delete_file',[App\Http\Controllers\ImageUploadController::class,'delete_file']);
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
    Route::get('report/purchase_report',[App\Http\Controllers\ReportController::class,'purchase_report']);
    Route::post('report/show_purchase_report',[App\Http\Controllers\ReportController::class,'show_purchase_report']);
    Route::post('report/get_purchase_report',[App\Http\Controllers\ReportController::class,'get_purchase_report']);  
    Route::get('user/open_issue/{id}',[App\Http\Controllers\UserController::class,'open_issue']);
    Route::post('update_issue_status',[App\Http\Controllers\UserController::class,'update_issue_status']);
    Route::get('view_issues',[App\Http\Controllers\UserController::class,'view_issues']);      
    Route::group(['middleware' => 'role:admin'], function() {
        Route::get('user/balance_history',[App\Http\Controllers\UserController::class,'balance_history']);
        Route::get('user/add_balance',[App\Http\Controllers\UserController::class,'add_balance']);
        Route::get('user/edit_balance/{id}',[App\Http\Controllers\UserController::class,'edit_balance']);
        Route::post('user/edit_balance',[App\Http\Controllers\UserController::class,'update_balance']);
        Route::post('user/add_balance',[App\Http\Controllers\UserController::class,'save_balance']);
        Route::post('user/check_username',[App\Http\Controllers\UserController::class,'check_username']);
        Route::get('user/balance_requests',[App\Http\Controllers\UserController::class,'balance_requests']);
        Route::post('user/accept_request',[App\Http\Controllers\UserController::class,'accept_request']);
        Route::get('user/open_request/{id}',[App\Http\Controllers\UserController::class,'open_account_request']);
        Route::get('user/purchase_requests',[App\Http\Controllers\UserController::class,'purchase_requests']);
        Route::get('user/pending_requests',[App\Http\Controllers\UserController::class,'pending_requests']);
        Route::get('user/open_balance_request/{id}',[App\Http\Controllers\UserController::class,'open_balance_request']);
        Route::post('user/save_accounts',[App\Http\Controllers\UserController::class,'save_accounts']);
        Route::get('product/view_accounts/{id}',[App\Http\Controllers\ProductController::class,'view_accounts']);
        Route::delete('user/reject_request',[App\Http\Controllers\UserController::class,'reject_request']);
        Route::resource("user",App\Http\Controllers\UserController::class);        
        Route::resource("product",App\Http\Controllers\ProductController::class);
        Route::resource("notification",App\Http\Controllers\NotificationController::class);
        Route::get('report/balance_report',[App\Http\Controllers\ReportController::class,'balance_report']);
        Route::delete('purchase/delete_record',[App\Http\Controllers\ReportController::class,'delete_record']);
        Route::get('purchase/modify_detail/{id}',[App\Http\Controllers\ReportController::class,'modify_detail']);
        Route::post('purchase/update_purchase_request',[App\Http\Controllers\ReportController::class,'update_purchase_request']);        
    });
    Route::group(['middleware' => 'role:user'], function() {
        Route::get('view_product',[App\Http\Controllers\HomeController::class,'view_products']);
        Route::get('view_purchases',[App\Http\Controllers\HomeController::class,'view_purchases']);
        Route::get('buy/{id}',[App\Http\Controllers\HomeController::class,'show_product']);
        Route::post('buy',[App\Http\Controllers\HomeController::class,'buy_product']);
        Route::get('balance/add_request',[App\Http\Controllers\HomeController::class,'add_balance']);
        Route::post('balance/add_request',[App\Http\Controllers\HomeController::class,'save_balance']);
        Route::get('balance/edit_request/{id}',[App\Http\Controllers\HomeController::class,'edit_balance']);
        Route::post('balance/edit_request',[App\Http\Controllers\HomeController::class,'update_balance']);
        Route::get('balance/view_request',[App\Http\Controllers\HomeController::class,'view_balance_requests']);
        Route::delete('balance/delete_request/{id}',[App\Http\Controllers\HomeController::class,'delete_balance']);
        Route::post('check_notification',[App\Http\Controllers\HomeController::class,'check_notification']);
        Route::get('view_notifications',[App\Http\Controllers\HomeController::class,'view_notifications']);
        Route::get('view_all_notifications',[App\Http\Controllers\HomeController::class,'read_all_notifications']);
        Route::get('open_purchase_account/{id}',[App\Http\Controllers\HomeController::class,'open_purchase_account']);
        Route::post('report_issue',[App\Http\Controllers\HomeController::class,'report_issue']);        
    });
        Route::get('logout', function ()
        {
            auth()->logout();
            Session()->flush();
            return Redirect::to('/login');
        })->name('logout');
});
Route::get('send-mail', function () {
   
    $details = [
        'title' => 'Mail from ItSolutionStuff.com',
        'body' => 'This is for testing email using smtp'
    ];
   
    \Mail::to('anuinfotech2009@gmail.com')->send(new \App\Mail\MyTestMail($details));
   
    dd("Email is Sent.");
});