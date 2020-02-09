<?php

namespace App\Http\Requests\Core\Account\ProjectEntities;

use App\Http\Requests\Core\Account\BaseAccountRequest;
use App\Rules\EntityNameUniqueForProject;

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
        $project = $this->route('project');

        return [
            'name' => ['required', 'string', new EntityNameUniqueForProject($project->id)],
            'description' => 'nullable|string'
        ];
    }
}
