<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CartDetail extends Model
{
    protected $table = 'cartdetail';
    protected $primaryKey = ['shoppingcart_id', 'product_id'];
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'shoppingcart_id',
        'product_id',
        'quantity',
    ];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }
}
