<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

/**
 * Class BaseFeatureTest
 * @package Tests\Feature
 */
abstract class BaseFeatureTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Create account for testing
     *
     * @return void
     */
    protected function prepareBeforeTests() : void
    {
        $user_data = config('tests.users')[0];

        $this->json('POST', route('core.auth.register'), $user_data);
    }
}
