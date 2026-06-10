<?php

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class VendorShippingCompanyRequest extends FormRequest
{
    public function authorize(): bool
    {
        return auth()->check();
    }

    public function rules(): array
    {
        return [
            'shipping_company_id' => [
                'required',
                'integer',
                Rule::exists('shipping_companies', 'id')->where('is_active', 1),
            ],
        ];
    }
}
