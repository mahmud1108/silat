<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class UpdateProfilAtletRequest extends FormRequest
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
            'atlet_nama' => ['required'],
            'atlet_email' => ['required', 'email', Rule::unique('atlets')->ignore(auth()->user()->id)],
            'no_hp' => ['required', 'max:14', Rule::unique('atlets')->ignore(auth()->user()->id)],
            'password' => 'confirmed'
        ];
    }
}
