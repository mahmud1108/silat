<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
            'user_nama' => 'string|required',
            'user_username' => ['required', 'string', Rule::unique('users')->ignore(auth()->user()->id)],
            'user_no_hp' => 'string|max:13',
            'user_alamat' => 'string|nullable',
            'user_email' => ['required', 'email', Rule::unique('users')->ignore(auth()->user()->id)],
            'password' => 'nullable|confirmed',
        ];
    }
}
