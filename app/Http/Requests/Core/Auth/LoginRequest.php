<?php

namespace App\Http\Requests\Core\Auth;

use App\Http\Requests\BaseApiRequest;

/**
 * Class LoginRequest
 * @package App\Http\Requests\Core\Auth
 */
class LoginRequest extends BaseApiRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ];
    }
}
