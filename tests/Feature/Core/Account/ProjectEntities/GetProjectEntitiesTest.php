<?php

namespace Tests\Feature\Core\Account\ProjectEntities;

use App\Models\Project;
use Illuminate\Http\Response;

/**
 * Class GetProjectEntitiesTest
 * @package Tests\Feature\Core\Account\ProjectEntities
 */
class GetProjectEntitiesTest extends AbstractProjectEntityTest
{
    /**
     * Check API, when we are using invalid data
     *
     * @test
     * @return void
     */
    public function testFail(): void
    {
        $this->createTestAccount();
        $this->setSignedUser();
        $this->createTestProjects();

        // 404 error
        $this->json('GET', route('core.account.project-entities.index', ['project' => self::NOT_EXIST]))
            ->assertStatus(Response::HTTP_NOT_FOUND);

        $project = Project::where('name', $this->test_projects[0]['name'])->first();

        $this->resetSignedUser();

        // 401 error
        $this->json('GET', route('core.account.project-entities.index', ['project' => $project->id]))
            ->assertStatus(Response::HTTP_UNAUTHORIZED);

        $this->setSignedUser();

        $this->createTestItems($project->id);

        // 422 errors
        $this->json('GET', route('core.account.project-entities.index', ['project' => $project->id]))
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->json(
            'GET',
            route('core.account.project-entities.index', ['limit' => 1, 'project' => $project->id])
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
        $this->json(
            'GET',
            route('core.account.project-entities.index', ['offset' => 1, 'project' => $project->id])
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);
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
        $this->createTestProjects();

        $project = Project::where('name', $this->test_projects[0]['name'])->first();
        $this->createTestItems($project->id);
    }
}
