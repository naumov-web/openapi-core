<?php

namespace App\Http\Requests\Core\Account\Projects;

use App\Http\Requests\Core\Account\BaseAccountRequest;
use App\Rules\ProjectNameUniqueForOwner;

/**
 * Class UpdateProjectRequest
 * @package App\Http\Requests\Core\Account\Projects
 */
class UpdateProjectRequest extends BaseAccountRequest
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
            'name' => ['required', 'string', new ProjectNameUniqueForOwner($project->id)],
            'description' => 'nullable|string',
            'format_id' => 'required|integer'
        ];
    }
}
