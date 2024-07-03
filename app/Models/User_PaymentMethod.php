<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;


class User_PaymentMethod extends Model
{
    protected $table = 'user_paymentmethod';
    protected $primaryKey = ['user_id', 'paymentmethod_id'];
    public $timestamps = false;

    public $incrementing = false;


    protected $fillable = [
        'user_id',
        'paymentmethod_id'
    ];
}