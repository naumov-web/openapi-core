<?php

namespace App\Repositories;

use App\Models\ProjectEntityField;

/**
 * Class ProjectEntityFieldsRepository
 * @package App\Repositories
 */
class ProjectEntityFieldsRepository extends AbstractRepository
{

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return ProjectEntityField::class;
    }
}
