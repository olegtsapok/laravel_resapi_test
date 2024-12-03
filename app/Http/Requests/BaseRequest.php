<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

/**
 * Base class for all requests
 */
class BaseRequest extends FormRequest
{
    /**
     * Check if request is for new model record
     *
     * @param int $modelId
     * @return bool
     */
    protected function isNew($modelId)
    {
        return ($modelId ? false : true);
    }
}
