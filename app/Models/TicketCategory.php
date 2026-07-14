<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TicketCategory extends Model
{
    protected $fillable = [
        'id',
        'name',
        'description',
    ];

    function tickets(){
        return $this->hasMany(Ticket::class, 'category_id');
    }
}
