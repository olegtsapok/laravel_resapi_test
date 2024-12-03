<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class for configuration model validation rules
 */
class CompanyRequest extends BaseRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules($modelId = null): array
    {
        $isNew = $this->isNew($modelId);

        return [
            'name'        => [
                Rule::requiredIf($isNew),
                'max:200'
            ],
            'nip'         => [
                Rule::requiredIf($isNew),
                Rule::unique('companies')->ignore($modelId),
                'digits:10'
            ],
            'address'     => Rule::requiredIf($isNew),
            'city'        => Rule::requiredIf($isNew),
            'postal_code' => [
                Rule::requiredIf($isNew),
                'regex:/^[0-9]{2}-[0-9]{3}$/',
            ]
        ];
    }
}
