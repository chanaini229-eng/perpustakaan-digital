<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class BukuRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'kategori_id' => 'required|exists:kategoris,id',
            'judul' => [
                'required',
                'string',
                'max:255',
                'regex:/^[^\d]+$/u',
            ],
            'penulis' => 'required|string|max:255',
            'tahun_terbit' => 'required|integer|min:1900',
        ];
    }

    public function messages(): array
    {
        return [
            'kategori_id.required' => 'Kategori wajib dipilih.',
            'kategori_id.exists' => 'Kategori yang dipilih tidak tersedia.',
            'judul.required' => 'Judul buku wajib diisi.',
            'judul.regex' => 'Judul buku tidak boleh mengandung angka.',
            'judul.max' => 'Judul buku maksimal 255 karakter.',
            'penulis.required' => 'Nama penulis wajib diisi.',
            'tahun_terbit.required' => 'Tahun terbit wajib diisi.',
            'tahun_terbit.integer' => 'Tahun terbit harus berupa angka bulat.',
            'tahun_terbit.min' => 'Tahun terbit tidak boleh kurang dari 1900.',
        ];
    }
}