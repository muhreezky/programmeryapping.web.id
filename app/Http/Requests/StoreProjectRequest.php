<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'title' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'url' => ['nullable', 'url', 'max:255'],
            'image' => ['nullable', 'image', 'max:2048'],
            'tags' => ['nullable', 'array'],
            'tags.*' => ['string', 'max:50'],
            'featured' => ['boolean'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Nama proyek wajib diisi.',
            'description.required' => 'Deskripsi proyek wajib diisi.',
            'url.url' => 'Format URL tidak valid.',
            'image.image' => 'File harus berupa gambar.',
        ];
    }
}
