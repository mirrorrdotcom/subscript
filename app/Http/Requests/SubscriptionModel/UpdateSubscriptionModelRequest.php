<?php

namespace App\Http\Requests\SubscriptionModel;

use App\Traits\HasRtf;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdateSubscriptionModelRequest extends FormRequest
{
    use HasRtf;

    protected function prepareForValidation()
    {
        if ($this->isRtfEmpty("description")) {
            $this->merge([ "description" => null ]);
        }

        $this->merge([
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
            "slug" => [
                "required",
                "string",
                "min:2",
                "max:255",
                Rule::unique("subscription_models", "slug")
                    ->where(
                        fn($q) => $q->whereNull("deleted_at")
                            ->where("id", "<>", $this->subscription_model->id)
                    ),
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
