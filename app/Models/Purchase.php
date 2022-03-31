<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $primaryKey='purchase_id';
    protected $timeststamps=true;
    const CREATED_AT = 'p_creation_date';
    const UPDATED_AT = 'p_updated_date';
    protected $fillable = [
        'user_id', 'product_id','quantity','total_price'
    ];
    public function purchase_detail() {
        return $this->hasMany('App\Models\PurchaseDetail','purchase_id');
    }
    public function products() {
        return $this->belongsTo('App\Models\Product','product_id');
    }
    public function users() {
        return $this->belongsTo('App\Models\User','user_id');
    }
}
