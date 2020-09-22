<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateConsumerPermissionsRequest extends FormRequest
{

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "permissions" => [ "nullable", "array" ],
            "permissions.*" => [ "nullable", "exists:permissions,id" ],
        ];
    }
}
