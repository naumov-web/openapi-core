<?php

namespace Tests\Feature\Core\Auth;

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
    }

}
