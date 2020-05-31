<?php

namespace App\Http\Requests\Currency;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateCurrencyRequest extends FormRequest
{
    protected function prepareForValidation()
    {
        $this->merge([
            "rate" => (float)$this->rate,
            "is_active" => $this->has("is_active")
        ]);
    }

    public function authorize()
    {
        if (!$this->currency) {
            return false;
        }

        return true;
    }

    public function rules()
    {
        return [
            "name" => [ "required", "string", "min:1", "max:255" ],
            "code" => [
                "required",
                "min:1",
                "max:255",
                Rule::unique("currencies", "code")
                    ->where(fn($q) =>
                        $q->whereNull("deleted_at")
                            ->where("id", "<>", $this->currency->id)
                    )
            ],
            "rate" => [ "required", "gt:0", "numeric" ],
            "symbol" => [ "nullable", "string", "min:1", "max:255" ],
            "is_active" => [ "required", "boolean" ]
        ];
    }
}
