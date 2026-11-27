<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreMessageRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // Public endpoint
    }

    public function rules(): array
    {
        return [
            'sender_name' => ['required', 'string', 'max:255'],
            'sender_email' => ['required', 'string', 'email', 'max:255'],
            'subject' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
        ];
    }

    public function messages(): array
    {
        return [
            'sender_name.required' => 'Nama pengirim wajib diisi.',
            'sender_name.max' => 'Nama maksimal 255 karakter.',
            'sender_email.required' => 'Email wajib diisi.',
            'sender_email.email' => 'Format email tidak valid.',
            'sender_email.max' => 'Email maksimal 255 karakter.',
            'subject.required' => 'Subjek pesan wajib diisi.',
            'subject.max' => 'Subjek maksimal 255 karakter.',
            'content.required' => 'Isi pesan wajib diisi.',
        ];
    }

    public function attributes(): array
    {
        return [
            'sender_name' => 'nama',
            'sender_email' => 'email',
            'subject' => 'subjek',
            'content' => 'pesan',
        ];
    }
}
