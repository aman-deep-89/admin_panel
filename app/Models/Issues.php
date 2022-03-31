<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Issues extends Model
{
    use HasFactory;
    public function purchase_detail() {
        return $this->belongsTo('App\Models\PurchaseDetail','pd_id');
    }
}
