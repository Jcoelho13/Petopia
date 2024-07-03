<?php

namespace App\Models\Notifications;

use App\Models\Wishlist;
use Illuminate\Database\Eloquent\Model;

class WishListNotification extends Model
{
    protected $table = 'wishlistnotification';
    public $timestamps  = false;
    public function notifications()
    {
        return $this->morphMany('App\Models\Notifications\Notification', 'notify');
    }

    public function wishlist()
    {
        return $this->belongsTo(WishList::class, 'wishlist_id');
    }
}