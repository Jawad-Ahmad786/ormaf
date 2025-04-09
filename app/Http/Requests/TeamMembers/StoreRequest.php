<?php

namespace App\Http\Requests\TeamMembers;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
            return [
                'first_name' => ['required', 'max:255'],
                'last_name'  => ['required', 'max:255'],
                'email'      => ['required', 'email', 'unique:users,email'],
                'image' => ['nullable', 'image', 'max:2048']
        ];
    }
}
