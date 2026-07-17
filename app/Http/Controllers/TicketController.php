<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Http\Requests\StoreTicketRequest;
use App\Http\Requests\UpdateTicketRequest;
use App\Models\TicketCategory;
use App\Enums\TicketStatus;
use App\Enums\TicketPriority;
use App\Models\ActivityLogs;

use App\Jobs\AnalyzeTicketAI;

class TicketController extends Controller
{
    public function index(Request $request)
    {
        $query = Ticket::with('user');

        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        if ($request->filled('priority')) {
            $query->where('priority', $request->priority);
        }

        if ($request->get('sort') === 'oldest') {
            $query->oldest();
        } else {
            $query->latest();
        }

        $tickets = $query->paginate(6)->appends($request->all());

        return view('tickets')->with('tickets', $tickets);
    }

    public function create()
    {
        $categories = TicketCategory::all();
        return view('tickets.create')->with('categories', $categories);
    }

    public function store(StoreTicketRequest $request)
    {
        $validated = $request->validated();


        $ticket = Ticket::create([
            'user_id'     => auth()->id(), 
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'priority'    => TicketPriority::Low, 
            'status'      => TicketStatus::Pending,
            'is_ai_processed' => false,
        ]);

       AnalyzeTicketAI::dispatch($ticket);

        return redirect()->route('tickets.index')
                         ->with('success', 'Biletiniz oluşturuldu. Yapay zeka analiz ediyor...');
    }

    public function show($id)
    {
        // Get ticket with user, messages and their users
        $ticket = Ticket::with(['user', 'messages.user', 'category', 'attachments'])->findOrFail($id);
        
        return view('ticket_details', compact('ticket'));
    }

    public function storeMessage(Request $request, $id)
    {
        $request->validate([
            'message' => 'required|string'
        ]);

        $ticket = Ticket::findOrFail($id);
        
        $ticket->messages()->create([
            'user_id' => auth()->id(),
            'message' => $request->message
        ]);

        return redirect()->route('tickets.show', $id);
    }

    public function update(UpdateTicketRequest $request, $id, \App\Services\TicketService $ticketService)
    {
        $validated = $request->validated();

        $ticket = Ticket::findOrFail($id);

        if ($request->has('cycle_status')) {
            $ticketService->cycleStatus($ticket, auth()->id());
            
            if ($request->wantsJson()) {
                $html = view('components.ticket-status', ['ticket' => $ticket, 'interactive' => true])->render();
                return response()->json([
                    'success' => true,
                    'message' => 'Status updated to ' . ucfirst($ticket->status->value),
                    'html' => $html
                ]);
            }
            return redirect()->back()->with('success', 'Status updated to ' . ucfirst($ticket->status->value));
        }

        if ($request->has('cycle_priority')) {
            $ticketService->cyclePriority($ticket, auth()->id());
            
            if ($request->wantsJson()) {
                $html = view('components.ticket-priority', ['ticket' => $ticket, 'interactive' => true])->render();
                return response()->json([
                    'success' => true,
                    'message' => 'Priority updated to ' . ucfirst($ticket->priority->value),
                    'html' => $html
                ]);
            }
            return redirect()->back()->with('success', 'Priority updated to ' . ucfirst($ticket->priority->value));
        }

        $ticket->update($validated);

        return redirect()->back()->with('success', 'Ticket updated successfully.');
    }

    public function destroy($id)
    {

        $ticket = Ticket::findOrFail($id);
        $ticket->delete();

        return redirect()->route('tickets.index')->with('success', 'Ticket deleted successfully.');
    }
}