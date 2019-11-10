<?php

namespace Tests\Feature\Core\Account\User;

use Illuminate\Http\Response;
use Tests\Feature\Core\Account\BaseAccountTest;

/**
 * Class GetUserTest
 * @package Tests\Feature\Core\Account\User
 */
class GetUserTest extends BaseAccountTest
{
    /**
     * Check API, when we are using invalid data
     *
     * @test
     * @return void
     */
    public function testFail() : void
    {
        $this->json('GET', route('core.account.user.show'))
            ->assertStatus(Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Check API, when we are using correct data
     *
     * @test
     * @return void
     */
    public function testSuccess() : void
    {
        $this->createTestAccount();

        $this->setSignedUser();

        $this->json('GET', route('core.account.user.show'))
            ->assertOk()
            ->assertJson([
                'email' => $this->getPrimaryUserEmail()
            ]);
    }
}
