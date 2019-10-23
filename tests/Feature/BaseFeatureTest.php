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
}
