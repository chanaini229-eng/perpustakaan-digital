<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBukuRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'kategori_id' => 'required|exists:kategoris,id',
            'judul' => 'required|string|min:3|max:150',
            'penulis' => 'required|string|min:3|max:100',
            'tahun_terbit' => 'required|integer|min:1900|max:' . date('Y'),
        ];
    }
    public function messages(): array
    {
        return [
            'kategori_id.required' => 'Kategori harus dipilih.',
            'kategori_id.exists' => 'Kategori yang dipilih tidak valid.',

            'judul.required' => 'Judul buku harus diisi.',
            'judul.string' => 'Judul buku harus berupa teks.',
            'judul.min' => 'Judul buku harus memiliki minimal :min karakter.',
            'judul.max' => 'Judul buku tidak boleh lebih dari :max karakter.',

            'penulis.required' => 'Nama penulis harus diisi.',
            'penulis.string' => 'Nama penulis harus berupa teks.',
            'penulis.min' => 'Nama penulis harus memiliki minimal :min karakter.',
            'penulis.max' => 'Nama penulis tidak boleh lebih dari :max karakter.',  

            'tahun_terbit.required' => 'Tahun terbit harus diisi.',
            'tahun_terbit.integer' => 'Tahun terbit harus berupa angka.',
            'tahun_terbit.min' => 'Tahun terbit minimal tahun 1900.',
            'tahun_terbit.max' => 'Tahun terbit tidak boleh lebih dari tahun saat ini.',
        ];
    }
    public function attributes(): array
    {
        return [
            'kategori_id' => 'Kategori',
            'judul' => 'Judul Buku',
            'penulis' => 'Nama Penulis',
            'tahun_terbit' => 'Tahun Terbit',
        ];

    }


}
