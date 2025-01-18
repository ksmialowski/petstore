<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class PetRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        $isRequired = $this->method() == 'POST' ? 'required' : 'nullable';

        return [
            'name' => [$isRequired, 'string', 'max:255'],
            'status' => [$isRequired, 'string', 'in:available, pending, sold'],
            'file' => [$isRequired, 'file', 'mimes:jpeg,png,jpg,gif,svg', 'max:2048'],
        ];
    }
}
