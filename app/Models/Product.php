<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'image', 'description', 'price', 'tags', 'stock'
    ];

    protected $casts = [
        'price' => 'decimal:2',
        'stock' => 'integer'
    ];

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'product';

    /**
     * The primary key associated with the table.
     *
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */
    public $timestamps = false;

    public function reviews(): HasMany
    {
        return $this->hasMany(Review::class);
    }

    public function averageRating(): float
    {
        return $this->reviews()->avg('rating') ?? 0;
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'product_category', 'product_id', 'category_id');
    }

    public function purchases(): HasMany
    {
        return $this->hasMany(PurchaseDetail::class, 'product_id');
    }

    public function getStock(): int
    {
        return $this->stock;
    }

    static public function userBought($product_id, $user_id): bool
    {
        $product_user_purchase_history = DB::table('purchasedetail as pd')
            ->join('purchase as p', 'pd.purchase_id', '=', 'p.id')
            ->where('p.user_id', $user_id)
            ->where('pd.product_id', $product_id)
            ->whereNotIn('p.tracking_status', ['Canceled', 'Shipped', 'Pending'])
            ->select('pd.product_id')
            ->get();

        return $product_user_purchase_history->isNotEmpty();
    }

    static public function userAlreadyReviewed($product_id, $user_id) : bool
    {
        $reviewExists = DB::select('
        SELECT 1
        FROM Review
        WHERE user_id = ? AND product_id = ?
        LIMIT 1
    ', [$user_id, $product_id]);
        return count($reviewExists) > 0;
    }

}
