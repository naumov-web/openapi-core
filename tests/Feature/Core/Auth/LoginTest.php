<?php

namespace Tests\Feature\Core\Auth;

use Illuminate\Http\Response;
use Tests\Feature\BaseFeatureTest;

/**
 * Class LoginTest
 * @package Tests\Feature\Core\Auth
 */
class LoginTest extends BaseFeatureTest
{
    /**
     * Check API, when we are using invalid data
     *
     * @test
     * @return void
     */
    public function testFail() : void
    {
        $this->prepareBeforeTests();

        $data = [];
        $this->json('POST', route('core.auth.login'), $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $data['email'] = config('tests.users')[0]['email'];
        $this->json('POST', route('core.auth.login'), $data)
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $data['password'] = config('tests.users')[0]['password'] . '_';
        $this->json('POST', route('core.auth.login'), $data)
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
        $this->prepareBeforeTests();
        $data = config('tests.users')[0];

        $this->json('POST', route('core.auth.login'), $data)
            ->assertOk();
    }
}
