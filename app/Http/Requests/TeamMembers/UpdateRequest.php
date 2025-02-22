<?php

namespace App\Http\Requests\TeamMembers;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class UpdateRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $user = $this->route('user');
        $userId = $user->id;

        return [
            'first_name' => ['required', 'max:255'],
            'last_name' => ['required', 'max:255'],
            'email' => ['required', 'email', 'unique:users,email,'.$userId],
            'password' => ['nullable', 'confirmed', Password::min(8)], // Password is optional
            'zip_code' => ['required'],
            'country_id' => ['required', Rule::exists('countries', 'id')],
            'state_id' => ['required', Rule::exists('states', 'id')],
            'city_id' => ['required', Rule::exists('cities', 'id')],
            'address' => ['required'],
            'image' => ['nullable', 'image', 'max:2048']
        ];
    }
}
