<?php

namespace App\Http\Requests\Core\Account\User;

use App\Http\Requests\Core\Account\BaseAccountRequest;

/**
 * Class UpdateUserRequest
 * @package App\Http\Requests\Core\Account\User
 */
class UpdateUserRequest extends BaseAccountRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() : array
    {
        return [
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
            'password' => 'nullable|confirmed|string|min:6',
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
