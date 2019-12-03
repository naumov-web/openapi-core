<?php

namespace App\Http\Resources\Account\Projects;

use App\Http\Resources\Account\BaseAccountResource;

/**
 * Class ProjectsResource
 * @package App\Http\Resources\Account\Projects
 */
class ProjectsResource extends BaseAccountResource
{

    /**
     * Convert object to array
     *
     * @param \Illuminate\Http\Request $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'base_url' => $this->base_url,
            'format_id' => $this->format_id,
            'format_name' => $this->format_name
        ];
    }

}
