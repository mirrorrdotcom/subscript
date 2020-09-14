<?php

namespace App\Http\Requests;

use App\Traits\HasRtf;
use Illuminate\Foundation\Http\FormRequest;

class UpdateConsumerRequest extends FormRequest
{
    use HasRtf;

    public function prepareForValidation()
    {
        if ($this->isRtfEmpty("description")) {
            $this->merge([ "description" => null ]);
        }

        $this->merge([
            "is_active" => $this->has("is_active")
        ]);
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
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
            "name" => [ "required", "string", "min:1", "max:255" ],
            "is_active" => [ "required", "boolean" ],
            "description" => [ "nullable", "string" ],
        ];
    }
}
