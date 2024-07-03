<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Token extends Model
{
    use HasFactory;

    protected $table = 'tokens';

    protected $fillable = [
        'token_value',
        'is_active',
        'user_id',
    ];

    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo(GlobalUser::class, 'user_id');
    }
}
