<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class WishlistDetail extends Model
{
    protected $table = 'product_wishlist';
    protected $primaryKey = ['product_id', 'wishlist_id'];
    public $timestamps = false;
    public $incrementing = false;

    protected $fillable = [
        'wishlist_id',
        'product_id',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function wishList(): BelongsTo
    {
        return $this->belongsTo(WishList::class, 'wishlist_id');
    }
}