<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    use HasFactory;

    protected $table = 'shoppingcart';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'user_id',
    ];

    public static function getCartByUserId($userId)
    {
        return self::where('user_id', $userId)->first();
    }

    public function products(): HasMany
    {
        return $this->hasMany(CartDetail::class, 'shoppingcart_id')
            ->join('product', 'cartdetail.product_id', '=', 'product.id')
            ->select('cartdetail.product_id', 'cartdetail.quantity', 'product.name', 'product.price', 'product.image');
    }

    public function getTotalQuantity(): int
    {
        return $this->products->sum('quantity');
    }

    public function getTotalPrice(): float
    {
        return $this->products->sum(function ($product) {
            return $product->price * $product->quantity;
        });
    }

    public function removeProduct($productId)
    {
        $this->products()->where('product_id', $productId)->delete();
    }

    public function removeAllProducts()
    {
        $this->products()->delete();
    }

    public static function clearCart()
    {
        $user = Auth::user();
        if ($user) {
            $cart = self::getCartByUserId($user->id());
            if ($cart) {
                $cart->removeAllProducts();
            }
        }
    }

    public function addProduct($productId, $quantity)
    {
        $existingProduct = $this->products()->where('product_id', $productId)->first();

        if ($existingProduct) {
            return $this->updateProductQuantity($productId, $existingProduct->quantity + $quantity);
        } else {
            return $this->products()->insert([
                'shoppingcart_id' => $this->id,
                'product_id' => $productId,
                'quantity' => $quantity
            ]);
        }
    }

    public function updateProductQuantity($productId, $quantity)
    {
        $s = DB::select('SELECT stock FROM product WHERE id = ?', [$productId]);
        if (!empty($s)) {
            $productStock = $s[0]->stock;
        } else {
            $productStock = 0;
        }

        info(json_encode(['quantity-im-gonna-have' => $quantity, 'stock' => $productStock]));

        if ($quantity > $productStock) {
            return false;
        }

        $this->products()->where('product_id', $productId)->update([
            'quantity' => $quantity,
        ]);
        return true;
    }
    public function hasProduct($productId)
    {
        return $this->products()->where('product_id', $productId)->exists();
    }
}

