<?php

namespace Tests\Feature\Core\Auth;

use App\Models\User;
use Illuminate\Http\Response;
use Tests\Feature\BaseFeatureTest;

/**
 * Class RegisterTest
 * @package Tests\Feature\Core\Auth
 */
class RegisterTest extends BaseFeatureTest
{

    /**
     * Check API, when we are using invalid data
     *
     * @test
     * @return void
     */
    public function testFail() : void
    {
        $data = [];
        $this->json('POST', route('core.auth.register'), $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $data['email'] = 'test@test.com';
        $this->json('POST', route('core.auth.register'), $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $data['password'] = '123456';
        $this->json('POST', route('core.auth.register'), $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $data['password_confirmation'] = 'qweasd';
        $this->json('POST', route('core.auth.register'), $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $data['password_confirmation'] = $data['password'];
        $this->json('POST', route('core.auth.register'), $data);
        $this->json('POST', route('core.auth.register'), $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Check API, when we are using correct data
     *
     * @test
     * @return void
     */
    public function testSuccess() : void
    {
        $data = [
            'email' => 'test@test.com',
            'password' => 'qweasd',
            'password_confirmation' => 'qweasd'
        ];
        $this->json('POST', route('core.auth.register'), $data)
            ->assertOk();

        $this->assertDatabaseHas(
            (new User())->getTable(),
            [
                'email' => $data['email']
            ]
        );
    }

}
