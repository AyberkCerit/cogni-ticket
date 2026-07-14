<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; // Authenticatable yerine standart Model çağrılır

class Ticket extends Model // Sınıf Model'den miras alır
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