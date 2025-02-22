<?php

namespace App\Http\Requests\SubPrograms;

use Illuminate\Foundation\Http\FormRequest;

class StoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        return [
             'program_id' => ['required', 'exists:programs,id'],
             'name' => ['required', 'max:255'],
             'objective' => ['required', 'exists:logic_model_components,id'],
             'manager' => ['required', 'max:255'],
             'value' => ['required', 'numeric', 'min:0'],
             'members' => ['required', 'array']
        ];
    }
}
