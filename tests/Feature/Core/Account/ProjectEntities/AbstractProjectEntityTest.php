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
     * Test items
     * @var array
     */
    protected $test_items = [
        [
            'name' => 'entity_0'
        ],
        [
            'name' => 'entity_1',
            'description' => 'Описание 1'
        ],
        [
            'name' => 'entity_2',
            'description' => 'Описание 2'
        ],
    ];

    /**
     * Create test items
     *
     * @return void
     */
    protected function createTestProjects(): void
    {
        foreach ($this->test_projects as $test_project) {
            $this->json('POST', route('core.account.projects.create'), $test_project);
        }
    }
}
