<?php

namespace App\Http\Requests\Currency;

use Illuminate\Foundation\Http\FormRequest;

class DeleteCurrencyRequest extends FormRequest
{
    public function authorize()
    {
        if (!$this->currency) {
            return false;
        }

        return true;
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
