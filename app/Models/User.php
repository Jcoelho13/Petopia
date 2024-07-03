<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Illuminate\Database\Eloquent\Relations\HasMany;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $table = 'user';
    public $timestamps  = false;

    protected $fillable = [
        'id',
        'admin_id',
        'wishlist_id',
        'shoppingcart_id',
        'wallet'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'wallet' => 'float',
        'admin_id' => 'integer',
        'wishlist_id' => 'integer',
        'shoppingcart_id' => 'integer',
    ];

    public function paymentMethods(): HasMany
    {
        return $this->hasMany(PaymentMethod::class, 'id');
    }

    public function getAllReviews(): HasMany
    {
        return $this->hasMany(Review::class, 'id');
    }

    public function getAllPurchases(): HasMany
    {
        return $this->hasMany(Purchase::class, 'id');
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(Purchase::class, 'user_id');
    }

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class, 'user_id');
    }
}

