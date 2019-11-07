<?php

namespace App\Services;

use App\Models\User;
use App\Repositories\AbstractRepository;
use App\Repositories\OwnersRepository;
use App\Repositories\UsersRepository;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

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
        /**
         * @var User $user
         */
        $user = $this->repository->store(
            array_merge(
                $data,
                [
                    'password' => Hash::make($data['password'])
                ]
            )
        );

        $this->owners_repository->store(
            [
                'owner_id' => $user->id,
                'owner_type' => get_class($user)
            ]
        );

        return $user;
    }

    /**
     * Get token by email and password
     *
     * @param array $data
     * @return string|null
     */
    public function attempt(array $data) : ?string
    {
        return JWTAuth::attempt($data);
    }

    /**
     * Get auth token by model
     *
     * @param User $user
     * @return string
     */
    public function login(User $user) : string
    {
        return JWTAuth::fromUser($user);
    }
}
