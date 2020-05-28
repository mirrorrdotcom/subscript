<?php

namespace App\Http\Requests\SubscriptionModel;

use App\Traits\HasRtf;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class CreateSubscriptionModelRequest extends FormRequest
{
    use HasRtf;

    protected function prepareForValidation()
    {
        if ($this->isRtfEmpty("description")) {
            $this->merge([ "description" => null ]);
        }

        $this->merge([
            "slug" => Str::slug($this->slug),
            "is_active" => $this->has("is_active"),
        ]);
    }

    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            "slug" => [
                "required",
                "string",
                "min:2",
                "max:255",
                Rule::unique("subscription_models", "slug")
                    ->where(fn($q) => $q->whereNull("deleted_at")),
            ],
            "name" => [
                "required",
                "string",
                "min:2",
                "max:255"
            ],
            "description" => [ "nullable", "string", "min:2" ],
            "is_active" => [ "required", "boolean" ]
        ];
    }
}
