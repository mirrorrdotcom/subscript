<?php

namespace App\Http\Requests\Customer;

use Illuminate\Foundation\Http\FormRequest;

class DeleteCustomerRequest extends FormRequest
{
    public function authorize()
    {
        if (!$this->customer) {
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
