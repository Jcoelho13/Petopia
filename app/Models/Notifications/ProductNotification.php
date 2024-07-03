<?php

namespace App\Models\Notifications;

use Illuminate\Database\Eloquent\Model;

class ProductNotification extends Model
{
    protected $table = 'productnotification';
    public $timestamps  = false;
    public function notifications()
    {
        return $this->morphMany('App\Models\Notifications\Notification', 'notify');
    }
}