<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ActivityLogs extends Model
{
    protected $fillable = [
        'user_id',
        'ticket_id',
        'action',
        'old_value',
        'new_value',
    ];

    public function ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
