<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreDealRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'object_owner_id' => 'required | integer',
            'customer_id' => 'required | integer',
            'object_id' => 'required | integer',
            'hour_price' => 'required | numeric',
            'total_price' => 'required | numeric',
            'starts_from' => 'required',
            'ends_on' => 'required',
            'confirmed' => 'sometimes | boolean',
        ];
    }
}
