<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEducationRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'institution' => ['required', 'string', 'max:255'],
            'degree' => ['required', 'string', 'max:255'],
            'field_of_study' => ['nullable', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'started_at' => ['required', 'date'],
            'ended_at' => ['nullable', 'date', 'after_or_equal:started_at'],
            'is_current' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'institution.required' => 'Institusi wajib diisi.',
            'degree.required' => 'Gelar/Jurusan wajib diisi.',
            'started_at.required' => 'Tanggal mulai wajib diisi.',
            'started_at.date' => 'Format tanggal mulai tidak valid.',
            'ended_at.date' => 'Format tanggal selesai tidak valid.',
            'ended_at.after_or_equal' => 'Tanggal selesai harus sama atau setelah tanggal mulai.',
        ];
    }

    public function attributes(): array
    {
        return [
            'institution' => 'institusi',
            'degree' => 'gelar/jurusan',
            'field_of_study' => 'bidang studi',
            'started_at' => 'tanggal mulai',
            'ended_at' => 'tanggal selesai',
        ];
    }

    public function withValidator($validator): void
    {
        $validator->after(function ($validator) {
            if ($this->boolean('is_current') && $this->filled('ended_at')) {
                $validator->errors()->add('ended_at', 'Tanggal selesai harus kosong jika masih sekolah di sini.');
            }
        });
    }
}
