<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreObjectRequest extends FormRequest
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
            'category_id' => 'required | integer',
            'owner_user_id' => '',
            'title' => 'required | string',
            'description' => 'required | string',
            'rating' => '',
            'coordinates' => '',
            'address' => 'required | string',
            'address_comment' => '',
            'inventory' => '',
            'benefits' => '',
            'hour_price' => 'required | numeric',
            'minimal_autodeal_rating' => '',
            'schedule' => '',
            'show_price_for_authorised_only' => '',
            'gallery' => '',
            'moderated' => 'sometimes | boolean',
            'panorama' => '',
        ];
    }
}
