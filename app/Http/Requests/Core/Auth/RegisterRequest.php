<?php

namespace App\Http\Requests\Core\Auth;

use App\Http\Requests\BaseApiRequest;

/**
 * Class RegisterRequest
 * @package App\Http\Requests\Auth
 */
class RegisterRequest extends BaseApiRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'email' => 'required|email|unique:users,email',
            'password' => 'required|confirmed|string|min:6',
        ];
    }

    /**
     * Get error messages
     *
     * @return array
     */
    public function messages()
    {
        return array_merge(
            parent::messages(),
            [
                'email.unique' => config('error_messages.email_unique')
            ]
        );
    }
}
