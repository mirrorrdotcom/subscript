<?php

namespace App\Http\Requests\Feature;

use App\Traits\HasRtf;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CreateFeatureRequest extends FormRequest
{
    use HasRtf;

    protected function prepareForValidation()
    {
        if ($this->isRtfEmpty("description")) {
            $this->merge([ "description" => null ]);
        }

        $this->merge([
            "subscription_model_id" => $this->subscription_model->id,
            "slug" => Str::slug($this->slug),
            "is_active" => $this->has("is_active")
        ]);
    }

    public function authorize()
    {
        if (!$this->subscription_model) {
            return false;
        }

        return true;
    }

    public function rules()
    {
        return [
            "subscription_model_id" => [ "required", "exists:subscription_models,id" ],
            "slug" => [
                "required",
                "string",
                "min:2",
                "max:255",
                Rule::unique("features", "slug")
                    ->where(fn($q) =>
                    $q->whereNull("deleted_at")
                        ->where("subscription_model_id", $this->subscription_model->id)),
            ],
            "name" => [
                "required",
                "string",
                "min:2",
                "max:255"
            ],
            "description" => [ "nullable", "string", "min:2" ],
            "is_active" => [ "required", "boolean" ],
            "limit" => [ "nullable", "numeric", "gt:0" ]
        ];
    }
}
