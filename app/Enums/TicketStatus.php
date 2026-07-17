<?php

namespace App\Enums;

enum TicketStatus: string
{
    case Pending = 'pending';
    case Resolved = 'resolved';
    case Closed = 'closed';
    case Active = 'active'; // Kept for legacy support in existing tickets

    public static function cycle(self $current): self
    {
        return match ($current) {
            self::Pending => self::Resolved,
            self::Resolved => self::Closed,
            self::Closed => self::Pending,
            self::Active => self::Pending, // active goes to pending in cycle
        };
    }
}
