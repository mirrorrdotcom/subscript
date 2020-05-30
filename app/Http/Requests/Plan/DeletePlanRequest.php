<?php

namespace App\Http\Requests\Plan;

use Illuminate\Foundation\Http\FormRequest;

class DeletePlanRequest extends FormRequest
{
    public function authorize()
    {
        if (!$this->subscription_model) {
            return false;
        }

        if (!$this->plan) {
            return false;
        }

        if ($this->plan->subscription_model_id !== $this->subscription_model->id) {
            return false;
        }

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
            //
        ];
    }
}
