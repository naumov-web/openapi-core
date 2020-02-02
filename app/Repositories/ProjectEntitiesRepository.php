<?php

namespace App\Repositories;

use App\Models\ProjectEntity;

/**
 * Class ProjectEntitiesRepository
 * @package App\Repositories
 */
class ProjectEntitiesRepository extends AbstractRepository
{

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return ProjectEntity::class;
    }
}
