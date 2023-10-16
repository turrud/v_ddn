<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactCourseUpdateRequest extends FormRequest
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
            'university' => ['required', 'max:255', 'string'],
            'major' => ['required', 'max:255', 'string'],
            'select_one' => [
                'required',
                'in:senin_selasa,rabu_kamis,jumat_sabtu',
            ],
            'time' => ['required', 'in:00.19_end'],
            'image' => ['image', 'max:1024', 'nullable'],
        ];
    }
}
