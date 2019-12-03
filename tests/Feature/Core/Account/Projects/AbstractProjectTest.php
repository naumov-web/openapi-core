<?php

namespace Tests\Feature\Core\Account\Projects;

use Tests\Feature\Core\Account\BaseAccountTest;

/**
 * Class AbstractProjectTest
 * @package Tests\Feature\Core\Account\Projects
 */
abstract class AbstractProjectTest extends BaseAccountTest
{

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
        [
            'name' => 'Проект 2',
            'description' => 'description 2',
            'format_id' => 2,
        ],
        [
            'name' => 'Проект 3',
            'description' => 'description 3',
            'format_id' => 2,
        ],
        [
            'name' => 'Проект 4',
            'description' => 'description 4',
            'format_id' => 1,
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
