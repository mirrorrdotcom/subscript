<?php

namespace App\Http\Requests\SubscriptionModel;

use Illuminate\Foundation\Http\FormRequest;

class DeleteSubscriptionModelRequest extends FormRequest
{
    public function authorize()
    {
        // TODO: Authorize delete.

        return true;
    }

    public function rules()
    {
        return [
            //
        ];
    }
}
