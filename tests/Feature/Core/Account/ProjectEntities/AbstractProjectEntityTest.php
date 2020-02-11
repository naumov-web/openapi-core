<?php

namespace Tests\Feature\Core\Account\ProjectEntities;

use Tests\Feature\Core\Account\BaseAccountTest;

/**
 * Class AbstractProjectEntityTest
 * @package Tests\Feature\Core\Account\ProjectEntities
 */
abstract class AbstractProjectEntityTest extends BaseAccountTest
{

    /**
     * Non existing item id
     * @var int
     */
    public const NOT_EXIST = 123;

    /**
     * Test projects data
     * @var array
     */
    protected $test_projects = [
        [
            'name' => 'Проект 1',
            'format_id' => 1,
            'description' => 'description 1',
        ],
    ];

    /**
     * Create test items
     *
     * @return void
     */
    protected function createTestItems(): void
    {
        foreach ($this->test_projects as $test_project) {
            $this->json('POST', route('core.account.projects.create'), $test_project);
        }
    }
}
