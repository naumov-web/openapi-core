<?php

namespace App\Repositories;

use App\Models\Owner;

/**
 * Class OwnersRepository
 * @package App\Repositories
 */
class OwnersRepository extends AbstractRepository
{

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return Owner::class;
    }
}
