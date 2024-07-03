<?php

namespace App\Models\Notifications;

use Illuminate\Database\Eloquent\Model;


class PurchaseNotification extends Model
{
    protected $table = 'purchasenotification';
    public $timestamps  = false;

    public function notifications()
    {
        return $this->morphMany('App\Models\Notifications\Notification', 'notify');
    }
}
