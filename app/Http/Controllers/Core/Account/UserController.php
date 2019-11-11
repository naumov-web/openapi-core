<?php

namespace App\Http\Controllers\Core\Account;

use App\Http\Requests\Core\Account\User\UpdateUserRequest;
use App\Http\Resources\Account\User\UserResource;
use App\Models\User;
use App\Services\UsersService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;

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

    /**
     * Get user info
     *
     * @return UserResource
     */
    public function show() : UserResource
    {
        return new UserResource(
            $this->users_service->getDetailedUser(
                $this->getSignedUser()
            )
        );
    }

    /**
     * Update user info
     *
     * @param UpdateUserRequest $request
     * @return JsonResponse
     */
    public function update(UpdateUserRequest $request) : JsonResponse
    {
        $this->users_service->update(auth()->user(), $request->only(['email', 'password']));

        return response()->json([
            'success' => true,
        ]);
    }

}
