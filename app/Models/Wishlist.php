<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Wishlist extends Model
{
    use HasFactory;

    protected $table = 'wishlist';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
    ];

    public static function getWishlistByUserId($userId)
    {
        return self::where('user_id', $userId)->first();
    }

    public function products(): HasMany
    {
        return $this->hasMany(WishlistDetail::class, 'wishlist_id')
            ->join('product', 'product_wishlist.product_id', '=', 'product.id')
            ->select('product_wishlist.product_id', 'product.name', 'product.price', 'product.stock', 'product.image');
    }

    public function removeProduct($productId)
    {
        $this->products()->where('product_id', $productId)->delete();
    }

    public function removeAllProducts()
    {
        $this->products()->delete();
    }

    public function addProduct($productId)
    {
        $existingProduct = $this->products()->where('product_id', $productId)->first();
        if (!$existingProduct) {
            $this->products()->insert([
                'wishlist_id' => $this->id,
                'product_id' => $productId,
            ]);
        }
    }
}