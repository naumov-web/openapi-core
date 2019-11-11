<?php

namespace Tests\Feature\Core\Account\User;

use App\Models\User;
use Illuminate\Http\Response;
use Tests\Feature\Core\Account\BaseAccountTest;

/**
 * Class UpdateUserTest
 * @package Tests\Feature\Core\Account\User
 */
class UpdateUserTest extends BaseAccountTest
{

    /**
     * New user password
     * @var string
     */
    public const NEW_PASSWORD = 'new_password';

    /**
     * Check API, when we are using invalid data
     *
     * @test
     * @return void
     */
    public function testFail() : void
    {
        $this->json('PUT', route('core.account.user.update'))
            ->assertStatus(Response::HTTP_UNAUTHORIZED);

        $this->createTestAccount();
        $this->setSignedUser();

        $this->json('PUT', route('core.account.user.update', [
           'email' => ''
        ]))->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->json('PUT', route('core.account.user.update', [
            'email' => $this->getPrimaryUserEmail(),
            'password' => self::NEW_PASSWORD
        ]))->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->json('PUT', route('core.account.user.update', [
            'email' => $this->getPrimaryUserEmail(),
            'password' => self::NEW_PASSWORD,
            'password_confirmation' => self::NEW_PASSWORD . '_'
        ]))->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
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

        $new_email = 'new_' . $this->getPrimaryUserEmail();

        $this->json('PUT', route('core.account.user.update', [
            'email' => $this->getPrimaryUserEmail()
        ]))->assertOk();

        $this->assertDatabaseHas((new User())->getTable(), [
            'email' => $this->getPrimaryUserEmail()
        ]);

        $this->json('PUT', route('core.account.user.update', [
            'email' => $new_email,
            'password' => self::NEW_PASSWORD,
            'password_confirmation' => self::NEW_PASSWORD
        ]))->assertOk();

        $this->json('POST', route('core.auth.login'), [
            'email' => $new_email,
            'password' => self::NEW_PASSWORD
        ])->assertOk();

        $this->assertDatabaseHas((new User())->getTable(), [
            'email' => $new_email
        ]);
    }
}
