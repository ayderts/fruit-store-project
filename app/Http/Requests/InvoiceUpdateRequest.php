<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InvoiceUpdateRequest extends FormRequest
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
            'customer_name' => 'string',
            'fruit_items' => 'array',
            'fruit_items.*.id' => 'required_with:fruit_items|exists:fruit_items,id',
            'fruit_items.*.quantity' => 'required_with:fruit_items|integer|min:1',
        ];
    }
}
