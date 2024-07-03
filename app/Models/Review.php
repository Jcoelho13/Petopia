<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'product_id', 'date', 'body', 'title', 'rating'
    ];

    /**
     * Get the product that the review belongs to.
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(GlobalUser::class)
            ->select(['id', 'name', 'profile_image']);
    }

    public function globalUser()
    {
        return $this->belongsTo(GlobalUser::class);
    }

    protected $table = 'review';

    public $timestamps = false;
}