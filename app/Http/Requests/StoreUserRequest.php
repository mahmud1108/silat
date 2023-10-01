<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreUserRequest extends FormRequest
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
            'user_nama' => 'string',
            'user_username' => 'string|min:8|unique:users',
            'password' => 'string|min:8|confirmed',
            'user_no_hp' => 'string|unique:users',
            'user_email' => 'email|string|unique:users',
            'user_alamat' => 'string',
            'user_status' => 'string',
            'user_gambar' => 'image'
        ];
    }
}
