<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class ShippingCompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check()
            && (
                (int) auth()->user()->type === 1
                || ((int) auth()->user()->type === 4 && (int) auth()->user()->vendor_id === 1)
            );
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:191'],
            'whatsapp_number' => ['required', 'string'],
            'delivery_duration' => ['required', 'string', 'max:100'],
            'is_active' => ['nullable', 'boolean'],
        ];
    }
}
