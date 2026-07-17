<?php

namespace App\Services;

use App\Models\Ticket;
use App\Models\ActivityLogs;
use App\Enums\TicketStatus;
use App\Enums\TicketPriority;

class TicketService
{
    /**
     * Cycles the status of a ticket to the next logical step and logs the activity.
     */
    public function cycleStatus(Ticket $ticket, int $userId): void
    {
        $oldStatus = $ticket->status;
        $ticket->status = TicketStatus::cycle($ticket->status);
        $ticket->save();

        ActivityLogs::create([
            'user_id' => $userId,
            'ticket_id' => $ticket->id,
            'action' => 'status_change',
            'old_value' => $oldStatus->value,
            'new_value' => $ticket->status->value,
        ]);
    }

    /**
     * Cycles the priority of a ticket to the next logical step and logs the activity.
     */
    public function cyclePriority(Ticket $ticket, int $userId): void
    {
        $oldPriority = $ticket->priority;
        $ticket->priority = TicketPriority::cycle($ticket->priority);
        $ticket->save();

        ActivityLogs::create([
            'user_id' => $userId,
            'ticket_id' => $ticket->id,
            'action' => 'priority_change',
            'old_value' => $oldPriority->value,
            'new_value' => $ticket->priority->value,
        ]);
    }
}
