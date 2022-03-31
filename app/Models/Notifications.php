<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Notifications extends Model
{
    use HasFactory;
    protected $primaryKey='notification_id';
    protected $fillable = [
        'user_id',
        'notification_text',
        'date_created','n_enable'
    ];
    public function users() {
        return $this->belongsTo('App\Models\User');
    }    
}
