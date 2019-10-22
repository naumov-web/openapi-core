<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\AbstractRepository;
use App\Repositories\OwnersRepository;
use App\Repositories\UsersRepository;

/**
 * Class UsersService
 * @package App\Services
 */
class UsersService extends AbstractEntityService
{

    /**
     * Users repository instance
     * @var UsersRepository
     */
    protected $repository;

    /**
     * Owners repository instance
     * @var OwnersRepository
     */
    protected $owners_repository;

    /**
     * UsersService constructor.
     * @param UsersRepository $repository
     * @param OwnersRepository $owners_repository
     */
    public function __construct(UsersRepository $repository, OwnersRepository $owners_repository)
    {
        $this->repository = $repository;
        $this->owners_repository = $owners_repository;
    }

    /**
     * @inheritDoc
     */
    protected function getRepository(): AbstractRepository
    {
        return $this->repository;
    }

    /**
     * Register new user
     *
     * @param array $data
     * @return User
     */
    public function register(array $data) : User
    {

    }
}
