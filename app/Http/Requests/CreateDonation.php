<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateDonation extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'is_monetary' => ['required', 'boolean'],
            'value' => ['required', 'string'],
            'quantity' => ['required', 'integer'],
            'category_id' => ['required', 'integer', 'exists:categories,id']
        ];
    }
}
