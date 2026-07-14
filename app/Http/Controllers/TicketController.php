<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ticket;
use App\Models\TicketCategory;

class TicketController extends Controller
{
    public function index()
    {
        $tickets = Ticket::all();
        return view('tickets.index')->with('tickets', $tickets);
    }

    public function create()
    {
        $categories = TicketCategory::all();
        return view('tickets.create')->with('categories', $categories);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required|string',
            'category_id' => 'required|exists:ticket_categories,id',
        ]);

        Ticket::create([
            'user_id'     => auth()->id(), 
            'title'       => $validated['title'],
            'description' => $validated['description'],
            'category_id' => $validated['category_id'],
            'priority'    => 'pending', 
            'status'      => 'active',
            'is_ai_processed' => false,
        ]);

        return redirect()->route('tickets.index')
                         ->with('success', 'Biletiniz oluşturuldu. Yapay zeka analiz ediyor...');
    }
}