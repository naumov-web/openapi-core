<?php

namespace App\Http\Requests\Core\Account\ProjectEntities;

use App\Http\Requests\Core\Account\BaseAccountRequest;

/**
 * Class CreateProjectEntityRequest
 * @package App\Http\Requests\Core\Account\ProjectEntities
 */
class CreateProjectEntityRequest extends BaseAccountRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'name' => ['required', 'string'],
            'description' => 'nullable|string'
        ];
    }
}
