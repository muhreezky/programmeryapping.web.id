<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdatePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        $postId = $this->route('post')?->id;

        return [
            'title' => ['required', 'string', 'max:255'],
            'content' => ['required', 'string'],
            'headline_image' => ['nullable', 'image', 'max:2048'],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'Judul artikel wajib diisi.',
            'title.max' => 'Judul artikel maksimal 255 karakter.',
            'content.required' => 'Konten artikel wajib diisi.',
            'headline_image.image' => 'File harus berupa gambar.',
            'headline_image.max' => 'Ukuran gambar maksimal 2MB.',
        ];
    }

    public function attributes(): array
    {
        return [
            'title' => 'judul',
            'content' => 'konten',
            'headline_image' => 'gambar headline',
        ];
    }
}
