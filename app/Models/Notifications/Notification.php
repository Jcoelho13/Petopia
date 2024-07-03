<?php

namespace App\Models\Notifications;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{
    protected $table = 'notification';
    public $timestamps = false;

    protected $fillable = [
        'date',
        'user_id',
        'is_read',
        'notify_type',
        'notify_id',
    ];

    protected $casts = [
        'is_read' => 'boolean',
    ];

    public function isRead(): bool
    {
        return (bool) $this->is_read;
    }


    public function notify()
    {
        return $this->morphTo();
    }
}
