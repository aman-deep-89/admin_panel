<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\DB;
use App\Models\Purchase;
use App\Models\PurchaseDetail;
use App\Models\Issues;
use Illuminate\Support\Facades\Auth;
class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {        
        view()->composer('*', function ($view)
            {
                view()->composer('*', function($view)
                {
                    if (Auth::check() && Auth::user()->hasRole('admin')) {
                        $notifications=Purchase::with('users')->where('p_status','=','pending')->where('p_read','=',0)->get();
                        $issues=Issues::with('purchase_detail')->where('issue_status','=','pending')->where('issue_read','=',0)->get();
                        $view->with(['notification'=>$notifications,'issues'=>$issues]);
                    }else if(Auth::check() && Auth::user()->hasRole('user')){
                        /*$notifications=PurchaseDetail::with(['purchases'=>function($query){
                            return $query->join('users','users.id','purchases.user_id')->join('products','products.id','purchases.product_id')->where('user_id','=',Auth::user()->id);
                        }])->whereIn('pd_status',['accepted','rejected'])->where('pd_read','=',0)->get();*/
                        $notifications=DB::select( DB::raw("SELECT *FROM purchase_details JOIN purchases USING(purchase_id) JOIN users ON users.id=purchases.user_id JOIN products ON  products.id=purchases.product_id WHERE user_id='".Auth::user()->id."' AND pd_status IN('accepted','rejected') AND pd_read=0"));
                        $view->with('user_notification', $notifications);
                    }
                });
            });
    }
}