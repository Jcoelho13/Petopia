<?php

namespace App\Models\Notifications;

use Illuminate\Database\Eloquent\Model;

class CartNotification extends Model
{
    protected $table = 'shoppingcartnotification';
    public $timestamps  = false;
    public function notifications()
    {
        return $this->morphMany('App\Models\Notifications\Notification', 'notify');
    }
}
