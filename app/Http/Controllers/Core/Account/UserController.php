<?php

namespace App\Http\Controllers\Core\Account;

use App\Http\Resources\Account\User\UserResource;
use App\Services\UsersService;

/**
 * Class UserController
 * @package App\Http\Controllers\Core\Account
 */
class UserController extends AbstractAccountController
{

    /**
     * Users service instance
     * @var UsersService
     */
    protected $users_service;

    /**
     * RegisterController constructor.
     * @param UsersService $users_service
     */
    public function __construct(UsersService $users_service)
    {
        $this->users_service = $users_service;
    }

    public function show() : UserResource
    {
        return new UserResource(
            $this->users_service->getDetailedUser(
                $this->getSignedUser()
            )
        );
    }

}
