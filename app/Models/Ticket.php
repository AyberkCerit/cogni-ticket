<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Enums\TicketStatus;
use App\Enums\TicketPriority;

class Ticket extends Model
{
    use HasFactory; // Notifiable ve UserFactory kaldırıldı

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'user_id',
        'title',
        'description',
        'status',
        'category_id',
        'priority',
        'ai_summary',
        'is_ai_processed',
    ];

    protected $casts = [
        'status' => TicketStatus::class,
        'priority' => TicketPriority::class,
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(TicketCategory::class);
    }
    
    public function messages()
    {
        return $this->hasMany(TicketMessage::class);
    }
    public function attachments()
    {
        return $this->hasMany(TicketAttachment::class);
    }
    
}