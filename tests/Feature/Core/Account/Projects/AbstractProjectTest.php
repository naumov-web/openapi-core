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
            'name' => 'pr1',
            'format_id' => 1,
        ],
        [
            'name' => 'pr2',
            'description' => 'description 2',
            'format_id' => 2,
        ]
    ];

}
