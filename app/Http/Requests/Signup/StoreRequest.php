<?php

namespace App\Http\Requests\Signup;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\Rule;

class StoreRequest extends FormRequest
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
        return [
             'first_name' => ['required', 'max:255'],
             'last_name'  => ['required', 'max:255'],
             'email'      => ['required', 'email', 'unique:users,email'],
             'password'   => ['required', 'confirmed', Password::min(8)],
             'zip_code'   => ['required'],
             'organization_name' => ['required'],
             'country' => ['required', Rule::exists('countries', 'id')],
             'state'   => ['required', Rule::exists('states', 'id')->where('country_id', $this->country)],
             'city'    => ['required', Rule::exists('cities', 'id')->where('state_id', $this->state)],
             'address'    => ['required']
        ];
    }
}
