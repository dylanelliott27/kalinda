<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreBillRequest extends FormRequest
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
            'due_date' => 'date|required',
            'bill_items' => 'array|filled|required',
            'bill_items.*.bill_issuer_id' => ['required', Rule::exists('bill_issuers', 'id')],
            'bill_items.*.amount' => 'numeric|required'
        ];
    }
}
