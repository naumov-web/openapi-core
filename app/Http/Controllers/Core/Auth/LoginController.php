<?php

namespace App\Http\Controllers\Core\Auth;

use App\Http\Controllers\Core\AbstractCoreController;
use App\Http\Requests\Core\Auth\LoginRequest;
use App\Services\UsersService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Validation\ValidationException;

/**
 * Class LoginController
 * @package App\Http\Controllers\Core\Auth
 */
class LoginController extends AbstractCoreController
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
     * Login user
     *
     * @param LoginRequest $request
     * @return JsonResponse
     * @throws ValidationException
     */
    public function login(LoginRequest $request) : JsonResponse
    {
        $token = $this->users_service->attempt($request->only(['email', 'password']));

        if (!$token) {
            throw ValidationException::withMessages(
                [
                    'email' => config('error_messages.incorrect_email_or_password')
                ]
            );
        }

        return response()->json([
            'success' => true,
            'token' => $token
        ]);
    }

}
