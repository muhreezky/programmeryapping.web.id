<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMessageRequest;
use App\Services\MessageService;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function __construct(
        protected MessageService $messageService
    ) {}

    /**
     * Store a visitor message.
     */
    public function store(StoreMessageRequest $request): RedirectResponse
    {
        $this->messageService->createFromContactForm($request->validated());

        return back()->with('success', 'Pesan terkirim, terima kasih sudah menghubungi saya!');
    }
}
