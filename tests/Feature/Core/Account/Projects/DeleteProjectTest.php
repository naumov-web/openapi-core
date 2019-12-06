<?php

namespace Tests\Feature\Core\Account\Projects;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Response;

/**
 * Class DeleteProjectTest
 * @package Tests\Feature\Core\Account\Projects
 */
class DeleteProjectTest extends AbstractProjectTest
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
            'DELETE',
            route('core.account.projects.delete', ['project' => self::NON_EXISTING_ID])
        )->assertStatus(Response::HTTP_NOT_FOUND);

        $this->prepareBeforeTests(self::SECOND_USER_INDEX);
        $this->setSignedUser(
            User::where('email', $this->getPrimaryUserEmail(self::SECOND_USER_INDEX))
                ->first()
        );
        $this->createTestItems();

        // 401 error
        $first_project = Project::query()->first();
        $this->resetSignedUser();
        $this->json(
            'DELETE',
            route('core.account.projects.delete', ['project' => $first_project->id])
        )->assertStatus(Response::HTTP_UNAUTHORIZED);

        $this->prepareBeforeTests();
        $this->setSignedUser();

        // 403 error
        $this->json(
            'DELETE',
            route('core.account.projects.delete', ['project' => $first_project->id])
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
        $this->json(
            'DELETE',
            route('core.account.projects.delete', ['project' => $first_project->id])
        )->assertOk();

        $this->assertDatabaseMissing(
            (new Project())->getTable(),
            $this->test_projects[0]
        );
    }
}
