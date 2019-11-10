<?php

namespace App\Repositories;

use App\Models\User;

/**
 * Class UsersRepository
 * @package App\Repositories
 */
class UsersRepository extends AbstractRepository
{

    /**
     * @inheritDoc
     */
    protected function getModelClass(): string
    {
        return User::class;
    }

    /**
     * Get detailed user
     *
     * @param User $model
     * @return User
     */
    public function getDetailedUser(User $model) : User
    {
        return $model;
    }
}
