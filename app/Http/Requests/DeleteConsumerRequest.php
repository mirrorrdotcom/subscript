<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class DeleteConsumerRequest extends FormRequest
{

    public function authorize()
    {
        if (!$this->consumer) {
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
