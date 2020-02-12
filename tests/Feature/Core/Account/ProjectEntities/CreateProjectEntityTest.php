<?php

namespace Tests\Feature\Core\Account\ProjectEntities;

use App\Models\Project;
use App\Models\ProjectEntity;
use Illuminate\Http\Response;

/**
 * Class CreateProjectEntityTest
 * @package Tests\Feature\Core\Account\ProjectEntities
 */
class CreateProjectEntityTest extends AbstractProjectEntityTest
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

        $this->json('POST', route('core.account.project-entities.create', ['project' => self::NOT_EXIST]))
            ->assertStatus(Response::HTTP_NOT_FOUND);

        $project = Project::where('name', $this->test_projects[0]['name'])->first();

        $this->resetSignedUser();

        $this->json(
            'POST',
            route('core.account.project-entities.create', ['project' => $project->id]),
            []
        )->assertStatus(Response::HTTP_UNAUTHORIZED);

        $this->setSignedUser();

        $this->json(
            'POST',
            route('core.account.project-entities.create', ['project' => $project->id]),
            []
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->json(
            'POST',
            route('core.account.project-entities.create', ['project' => $project->id]),
            ['name' => 'entity1']
        );

        $this->json(
            'POST',
            route('core.account.project-entities.create', ['project' => $project->id]),
            ['name' => 'entity1']
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

        foreach ($this->test_items as $test_item) {
            $this->json(
                'POST',
                route('core.account.project-entities.create', ['project' => $project->id]),
                $test_item
            )->assertOk();
        }

        foreach ($this->test_items as $test_item) {
            $this->assertDatabaseHas(
                (new ProjectEntity())->getTable(),
                array_merge(
                    $test_item,
                    [
                        'project_id' => $project->id,
                    ]
                )
            );
        }

    }
}
