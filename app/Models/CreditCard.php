<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CreditCard extends Model
{
    use HasFactory;

    protected $fillable = [
        'paymentmethod_id',
        'cvv',
        'number',
        'date',
    ];

    public $timestamps = false;

    protected $table = 'creditcard';

    protected $primaryKey = 'paymentmethod_id';

    public $incrementing = false;

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'paymentmethod_id');
    }
}
