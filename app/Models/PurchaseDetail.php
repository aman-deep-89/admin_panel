<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    use HasFactory;
    protected $primaryKey='pd_id';
    protected $timeststamps=true;
    const CREATED_AT = 'pd_creation_date';
    const UPDATED_AT = 'pd_updated_date';
    protected $fillable = [
        'purchase_id','pd_price', 'pd_quantity','pd_username','pd_password','pd_start_date','pd_end_date','pd_remarks','pd_status','pd_read'
    ];
    public function purchases() {
        return $this->belongsTo('App\Models\Purchase','purchase_id');
    }
}