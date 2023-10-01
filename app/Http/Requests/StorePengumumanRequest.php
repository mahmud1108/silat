<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StorePengumumanRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'pengumuman_judul' => 'required',
            'pengumuman_tanggal' => 'required',
            'pengumuman_isi' => 'required',
            'file' => 'mimes:png,jpg,jpeg,pdf,docx|nullable'
        ];
    }
}
