<?php

namespace App\Http\Resources\Account\ProjectEntities;

use App\Http\Resources\Account\BaseAccountResource;

/**
 * Class ProjectEntityResource
 * @package App\Http\Resources\Account\ProjectEntities
 */
class ProjectEntityResource extends BaseAccountResource
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
        ];
    }
}
