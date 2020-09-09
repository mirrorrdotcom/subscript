<?php

namespace App\Http\Requests\Customer;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCustomerPlanRequest extends FormRequest
{

    public function prepareForValidation()
    {
        $this->merge([
            "subscription_date" => Carbon::now()->toDateTimeString()
        ]);
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "plan_id" => [ "required", "integer", "exists:plans,id" ],
            "subscription_date" => [ "required", "date" ],
        ];
    }
}
