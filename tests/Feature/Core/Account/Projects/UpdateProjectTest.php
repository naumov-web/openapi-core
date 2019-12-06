<?php

namespace Tests\Feature\Core\Account\Projects;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Response;

/**
 * Class UpdateProjectTest
 * @package Tests\Feature\Core\Account\Projects
 */
class UpdateProjectTest extends AbstractProjectTest
{

    /**
     * Non existing id
     * @var int
     */
    public const NON_EXISTING_ID = 123;

    /**
     * Second user id
     * @var int
     */
    public const SECOND_USER_INDEX = 1;

    /**
     * Check API, when we are using invalid data
     *
     * @test
     * @return void
     */
    public function testFail(): void
    {
        // 404 error
        $this->json(
            'PUT',
            route('core.account.projects.update', ['project' => self::NON_EXISTING_ID])
        )->assertStatus(Response::HTTP_NOT_FOUND);

        $this->prepareBeforeTests(self::SECOND_USER_INDEX);
        $this->setSignedUser(
            User::where('email', $this->getPrimaryUserEmail(self::SECOND_USER_INDEX))
                ->first()
        );
        $this->createTestItems();

        // 422 Error
        $first_project = Project::query()->first();
        $this->json(
            'PUT',
            route('core.account.projects.update', ['project' => $first_project->id]),
            $this->test_projects[1]
        )->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        // 401 error
        $this->resetSignedUser();
        $this->json(
            'PUT',
            route('core.account.projects.update', ['project' => $first_project->id])
        )->assertStatus(Response::HTTP_UNAUTHORIZED);

        $this->prepareBeforeTests();
        $this->setSignedUser();

        // 403 error
        $this->json(
            'PUT',
            route('core.account.projects.update', ['project' => $first_project->id])
        )->assertStatus(Response::HTTP_FORBIDDEN);
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
        $this->createTestItems();

        $first_project = Project::query()->first();
        $new_project_data = $this->test_projects[0];

        $new_project_data['name'] = 'Новый проект';
        $new_project_data['description'] = 'Описание нового проекта';
        $new_project_data['format_id'] = 2;

        $this->json(
            'PUT',
            route('core.account.projects.update', ['project' => $first_project->id]),
            $new_project_data
        )->assertOk();

        $this->assertDatabaseHas(
            (new Project())->getTable(),
            $new_project_data
        );

        $this->assertDatabaseMissing(
            (new Project())->getTable(),
            $this->test_projects[0]
        );
    }

}
