<?php

namespace App\Enums;

enum TicketPriority: string
{
    case Low = 'low';
    case Medium = 'medium';
    case High = 'high';
    case Urgent = 'urgent';

    public static function cycle(self $current): self
    {
        return match ($current) {
            self::Low => self::Medium,
            self::Medium => self::High,
            self::High => self::Urgent,
            self::Urgent => self::Low,
        };
    }
}
