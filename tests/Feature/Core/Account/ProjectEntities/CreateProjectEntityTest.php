<?php

namespace Tests\Feature\Core\Account\ProjectEntities;

use App\Models\Project;
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
        $this->createTestItems();

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
}
