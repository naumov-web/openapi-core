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
     * Get primary user email
     *
     * @param int $index
     * @return mixed
     */
    protected function getPrimaryUserEmail(int $index = 0)
    {
        return config('tests.users')[$index]['email'];
    }

    /**
     * Create account for testing
     *
     * @param int $index
     * @return void
     */
    protected function prepareBeforeTests(int $index = 0) : void
    {
        $user_data = config('tests.users')[$index];

        $this->json('POST', route('core.auth.register'), $user_data);
    }
}
