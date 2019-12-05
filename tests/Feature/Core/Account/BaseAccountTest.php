<?php

namespace Tests\Feature\Core\Account;

use App\Models\User;
use Illuminate\Foundation\Testing\TestResponse;
use Tests\Feature\BaseFeatureTest;
use Tymon\JWTAuth\Facades\JWTAuth;

/**
 * Class BaseAccountTest
 * @package Tests\Feature\Core\Account
 */
abstract class BaseAccountTest extends BaseFeatureTest
{

    /**
     * Signed user instance
     * @var User
     */
    protected $signed_user;

    /**
     * Set signed user
     *
     * @param User $user
     * @return void
     */
    protected function setSignedUser(User $user = null) : void
    {
        if (is_null($user)) {
            $user = User::where('email', $this->getPrimaryUserEmail())->first();
        }

        $this->signed_user = $user;
    }

    /**
     * Reset signed user
     *
     * @return void
     */
    protected function resetSignedUser(): void
    {
        $this->signed_user = null;
    }

    /**
     * Execute json request
     *
     * @param string $method
     * @param string $uri
     * @param array $data
     * @param array $headers
     *
     * @return TestResponse
     */
    public function json($method, $uri, array $data = [], array $headers = []) : TestResponse
    {
        if ($this->signed_user) {
            $headers = array_merge([
                'Authorization' => 'Bearer ' . JWTAuth::fromUser($this->signed_user),
            ], $headers);
        }

        return parent::json($method, $uri, $data, $headers);
    }

    /**
     * Create test account
     *
     * @return void
     */
    protected function createTestAccount() : void
    {
        $this->prepareBeforeTests();
    }
}
