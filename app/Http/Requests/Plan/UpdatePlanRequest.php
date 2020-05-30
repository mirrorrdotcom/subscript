<?php

namespace App\Http\Requests\Plan;

use App\Services\TimeInterval;
use App\Traits\HasRtf;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class UpdatePlanRequest extends FormRequest
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
            "is_active" => $this->has("is_active"),
            "features" => $this->features ?? []
        ]);
    }

    public function authorize()
    {
        if (!$this->subscription_model) {
            return false;
        }

        if (!$this->plan) {
            return false;
        }

        if ($this->subscription_model->id !== $this->plan->subscription_model_id) {
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
                Rule::unique("plans", "slug")
                    ->where(fn($q) =>
                    $q->whereNull("deleted_at")
                        ->where("subscription_model_id", $this->subscription_model->id)
                        ->where("id", "<>", $this->plan->id))
            ],
            "name" => [
                "required",
                "string",
                "min:2",
                "max:255"
            ],
            "description" => [ "nullable", "string", "min:2" ],
            "is_active" => [ "required", "boolean" ],
            "trial_period" => [ "numeric", "gte:0" ],
            "trial_interval" => [ "in:" . TimeInterval::intervalsValidation() ],
            "recurring_period" => [ "numeric", "gte:0" ],
            "recurring_interval" => [ "in:" . TimeInterval::intervalsValidation() ],
            "grace_period" => [ "numeric", "gte:0" ],
            "grace_interval" => [ "in:" . TimeInterval::intervalsValidation() ],
            "features" => [ "array", "present" ],
            "features.*" => [
                Rule::exists("features", "id")
                    ->where(fn($q) =>
                    $q->whereNull("deleted_at")
                        ->where("subscription_model_id", $this->subscription_model->id)
                    )
            ]
        ];
    }
}
