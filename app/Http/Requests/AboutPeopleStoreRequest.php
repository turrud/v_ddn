<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutPeopleStoreRequest extends FormRequest
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
     */
    public function rules(): array
    {
        return [
            'name' => ['required', 'max:255', 'string'],
            'jabatan' => ['required', 'max:255', 'string'],
            'text' => ['required', 'max:255', 'string'],
            'image' => ['nullable', 'image', 'max:1024'],
        ];
    }
}
