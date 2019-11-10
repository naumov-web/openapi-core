<?php

namespace App\Http\Resources\Account\User;

use App\Http\Resources\Account\BaseAccountResource;

/**
 * Class UserResource
 * @package App\Http\Resources\Account\User
 */
class UserResource extends BaseAccountResource
{

    public function toArray($request)
    {
        return [
            'email' => $this->email,
        ];
    }

}
