<?php

namespace App\Http\Requests\Feature;

use Illuminate\Foundation\Http\FormRequest;

class DeleteFeatureRequest extends FormRequest
{
    public function authorize()
    {
        if (!$this->subscription_model) {
            return false;
        }

        if (!$this->feature) {
            return false;
        }

        if ($this->feature->subscription_model_id !== $this->subscription_model->id) {
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
