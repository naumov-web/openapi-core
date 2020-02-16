<?php

namespace Tests\Feature\Core\Handbooks;

use Tests\Feature\BaseFeatureTest;

/**
 * Class PublicTest
 * @package Tests\Feature\Core\Handbooks
 */
class PublicTest extends BaseFeatureTest
{
    /**
     * Handbook must return correct data
     *
     * @test
     * @return void
     */
    public function testSuccess() : void
    {
        $this->json('GET', route('core.handbooks.public.all.show'))
            ->assertOk()
            ->assertJson([
                'formats' => config('handbooks.formats'),
                'field_types' => config('handbooks.field_types')
            ]);
    }
}
