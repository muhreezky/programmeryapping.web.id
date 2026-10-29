<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    /**
     * Store a visitor message.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'sender_name' => 'required|string|max:255',
            'sender_email' => 'required|string|email|max:255',
            'subject' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Message::create($validated);

        return back()->with('success', 'Pesan terkirim, terima kasih sudah menghubungi saya!');
    }
}
