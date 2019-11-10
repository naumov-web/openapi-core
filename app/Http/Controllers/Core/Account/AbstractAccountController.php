<?php

namespace App\Http\Controllers\Core\Account;

use App\Http\Controllers\Core\AbstractCoreController;
use App\Models\User;

/**
 * Class AbstractAccountController
 * @package App\Http\Controllers\Core\Account
 */
class AbstractAccountController extends AbstractCoreController
{

    /**
     * Get signed user
     *
     * @return User|null
     */
    protected function getSignedUser() : ?User
    {
        return auth()->user();
    }

}
