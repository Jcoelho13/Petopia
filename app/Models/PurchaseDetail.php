<?php

// PurchaseDetail.php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseDetail extends Model
{
    protected $fillable = [
        'purchase_id',
        'product_id',
        'quantity',
        'price',
    ];

    protected $table = 'purchasedetail';

    public $timestamps = false;

    protected $primaryKey = ['purchase_id', 'product_id'];

    public $incrementing = false;

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }
}
