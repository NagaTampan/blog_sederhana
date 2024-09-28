<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreArticleRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        // Mengizinkan semua pengguna untuk membuat artikel
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title' => 'required|string|max:255',
            'desc' => 'nullable|string',
            'category_id' => 'required|exists:categories,id',
            'status' => 'required|boolean',
          
            'views' => 'nullable|string',
            'img' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Menyesuaikan ukuran gambar dan tipe
            'slug' => 'nullable|string|unique:articles,slug',
           
        ];
    }
}
