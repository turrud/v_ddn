<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactServiceStoreRequest extends FormRequest
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
            'business_need' => [
                'required',
                'in:design_build,furniture_only,design_only',
            ],
            'name' => ['required', 'max:255', 'string'],
            'phone_number' => ['required', 'max:255'],
            'email' => ['required', 'email'],
            'company_name' => ['required', 'max:255', 'string'],
            'location' => ['required', 'max:255', 'string'],
            'luas' => ['required', 'in:below_100m,100m_200m,above_200m'],
            'project_value' => [
                'required',
                'in:100_200_juta,200_500_juta,500_juta',
            ],
            'info' => ['nullable', 'max:255', 'string'],
            'rencana_meeting' => ['required', 'date'],
            'rencana_pembayaran' => ['required', 'date'],
        ];
    }
}
