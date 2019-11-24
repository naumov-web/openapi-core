<?php

namespace App\Http\Requests\Core\Account\Projects;

use App\Http\Requests\Core\Account\BaseAccountRequest;
use App\Rules\ProjectNameUniqueForOwner;

/**
 * Class CreateProjectRequest
 * @package App\Http\Requests\Core\Account\Projects
 */
class CreateProjectRequest extends BaseAccountRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'name' => ['required', 'string', new ProjectNameUniqueForOwner()],
            'description' => 'nullable|string',
            'format_id' => 'required|integer'
        ];
    }
}
