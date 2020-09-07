<?php

namespace App\Http\Requests\Customer;

use App\Traits\HasRtf;
use Illuminate\Foundation\Http\FormRequest;

class CreateCustomerRequest extends FormRequest
{
    use HasRtf;

    protected function prepareForValidation()
    {
        if ($this->isRtfEmpty("description")) {
            $this->merge([ "description" => null ]);
        }

        $this->merge([
            "is_active" => $this->has("is_active")
        ]);
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "name" => [ "required", "string", "min:1", "max:255" ],
            "is_active" => [ "required", "boolean" ],
            "description" => [ "nullable", "string", "min:2" ],
        ];
    }
}
