<?php

namespace App\Accessors;

use App\Models\Project;
use App\Models\User;

/**
 * Class ProjectAccessor
 * @package App\Accessors
 */
class ProjectAccessor
{

    /**
     * Check access
     *
     * @param User $user
     * @param Project $project
     * @return bool
     */
    public function check(User $user, Project $project): bool
    {
        $owner = $user->abstract_owner;

        return $project->owner_id == $owner->id;
    }

}
