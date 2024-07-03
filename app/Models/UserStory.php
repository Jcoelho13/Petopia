<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStory extends Model
{
    use HasFactory;
    protected $table = 'userstories';
    protected $fillable=[
        'number',
        'name',
        'priority',
        'description',
    ];
}
