<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaymentMethod extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
    ];

    protected $table = 'paymentmethod';

    public $timestamps = false;

    public static function findByName($name)
    {
        return static::where('name', $name)->value('id');
    }

    public function creditCards(){
        return $this->hasMany(CreditCard::class, 'paymentmethod_id');
    }

    public function mbway(){
        return $this->hasMany(MBWay::class, 'paymentmethod_id');
    }
}
