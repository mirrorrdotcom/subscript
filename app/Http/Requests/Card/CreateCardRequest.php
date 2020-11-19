<?php

namespace App\Http\Requests\Card;

use Illuminate\Foundation\Http\FormRequest;

class CreateCardRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'card_number' => 'required',
            'expiry_month' => 'required|numeric|digits:2|between:1,12',
            'expiry_year' => 'required|numeric|digits:4',
            'cvv' => 'required|digits:3',
            'name' => 'string',
            'primary' => 'boolean',
        ];
    }
}
