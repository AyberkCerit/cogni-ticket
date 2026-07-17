<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactMessageController extends Controller
{
    public function create()
    {
        return view('contact');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'subject' => 'nullable|string|max:255',
            'message' => 'required|string|max:2000',
        ]);

        \App\Models\ContactMessage::create($validated);

        if ($request->wantsJson()) {
            return response()->json(['message' => __('Your message has been successfully sent!')]);
        }

        return redirect()->back()->with('status', __('Your message has been successfully sent!'));
    }
}
