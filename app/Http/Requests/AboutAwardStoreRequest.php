<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AboutAwardStoreRequest extends FormRequest
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
            'tanggal' => ['required', 'max:255', 'string'],
            'award1' => ['required', 'max:255', 'string'],
            'award2' => ['nullable', 'max:255', 'string'],
            'award3' => ['nullable', 'max:255', 'string'],
            'award4' => ['nullable', 'max:255', 'string'],
            'award5' => ['nullable', 'max:255', 'string'],
            'image' => ['nullable', 'image', 'max:1024'],
        ];
    }
}
