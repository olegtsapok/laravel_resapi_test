<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Class for configuration model validation rules
 */
class EmployeeRequest extends BaseRequest
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
            'company_id' => Rule::requiredIf($isNew),
            'name'       => Rule::requiredIf($isNew),
            'surname'    => Rule::requiredIf($isNew),
            'email'      => [
                Rule::requiredIf($isNew),
                Rule::unique('employees')->ignore($modelId),
                'email',
            ],
            'phone'      => 'numeric',
        ];
    }
}
