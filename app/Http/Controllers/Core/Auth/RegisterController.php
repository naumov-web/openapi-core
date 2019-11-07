<?php

namespace App\Http\Controllers\Core\Auth;

use App\Http\Controllers\Core\AbstractCoreController;
use App\Http\Requests\Core\Auth\RegisterRequest;
use App\Services\UsersService;
use Illuminate\Http\JsonResponse;

/**
 * Class RegisterController
 * @package App\Http\Controllers\Auth
 */
class RegisterController extends AbstractCoreController
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
     * Register new user
     *
     * @param RegisterRequest $request
     * @return JsonResponse
     */
    public function register(RegisterRequest $request) : JsonResponse
    {
        $user = $this->users_service->register($request->only(
            [
                'email',
                'password'
            ]
        ));
        $token = $this->users_service->login($user);

        return response()->json([
            'success' => true,
            'token' => $token
        ]);
    }

}
