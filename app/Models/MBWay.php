<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MBWay extends Model
{
    use HasFactory;

    protected $fillable = [
        'paymentmethod_id',
        'phonenumber',
    ];

    protected $table = 'mbway';

    public $timestamps = false;

    protected $primaryKey = 'paymentmethod_id';

    public $incrementing = false;

    public function paymentMethod()
    {
        return $this->belongsTo(PaymentMethod::class, 'paymentmethod_id');
    }
}