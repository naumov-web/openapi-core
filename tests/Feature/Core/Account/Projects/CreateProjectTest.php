<?php

namespace Tests\Feature\Core\Account\Projects;

use App\Models\Project;
use Illuminate\Http\Response;

/**
 * Class CreateProjectTest
 * @package Tests\Feature\Core\Account\Projects
 */
class CreateProjectTest extends AbstractProjectTest
{

    /**
     * Check API, when we are using invalid data
     *
     * @test
     * @return void
     */
    public function testFail(): void
    {
        $this->json('POST', route('core.account.projects.create'))
            ->assertStatus(Response::HTTP_UNAUTHORIZED);

        $this->createTestAccount();
        $this->setSignedUser();

        $this->json('POST', route('core.account.projects.create'), [])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->json('POST', route('core.account.projects.create'), ['name' => 'pr1'])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->json('POST', route('core.account.projects.create'), $this->test_projects[1]);

        $this->json('POST', route('core.account.projects.create'), $this->test_projects[1])
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
    }

    /**
     * Check API, when we are using correct data
     *
     * @test
     * @return void
     */
    public function testSuccess() : void
    {
        $this->createTestAccount();
        $this->setSignedUser();

        foreach ($this->test_projects as $test_project) {
            $this->json('POST', route('core.account.projects.create'), $test_project)
                ->assertOk();

            $this->assertDatabaseHas(
                (new Project())->getTable(),
                $test_project
            );
        }
    }

}
