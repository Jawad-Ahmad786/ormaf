<?php

namespace App\Http\Requests\Programs;

use Illuminate\Foundation\Http\FormRequest;

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
        return [
             'name' => ['required', 'max:255'],
             'objective' => ['required', 'exists:logic_model_components,id'],
             'manager' => ['required', 'max:255'],
             'value' => ['required', 'numeric', 'min:0'],
             'members' => ['required', 'array']
        ];
    }
}
