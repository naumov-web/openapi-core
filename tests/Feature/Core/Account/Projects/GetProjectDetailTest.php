<?php

namespace Tests\Feature\Core\Account\Projects;

use App\Models\Project;
use App\Models\User;
use Illuminate\Http\Response;

/**
 * Class GetProjectDetailTest
 * @package Tests\Feature\Core\Account\Projects
 */
class GetProjectDetailTest extends AbstractProjectTest
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
            'GET',
            route('core.account.projects.show', ['project' => self::NON_EXISTING_ID])
        )->assertStatus(Response::HTTP_NOT_FOUND);

        $this->prepareBeforeTests(self::SECOND_USER_INDEX);
        $this->setSignedUser(
            User::where('email', $this->getPrimaryUserEmail(self::SECOND_USER_INDEX))
                ->first()
        );
        $this->createTestItems();

        // 401 error
        $this->resetSignedUser();
        $first_project = Project::query()->first();
        $this->json(
            'GET',
            route('core.account.projects.show', ['project' => $first_project->id])
        )->assertStatus(Response::HTTP_UNAUTHORIZED);

        $this->prepareBeforeTests();
        $this->setSignedUser();

        // 403 error
        $this->json(
            'GET',
            route('core.account.projects.show', ['project' => $first_project->id])
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
            'GET',
            route('core.account.projects.show', ['project' => $first_project->id])
        )->assertOk()
        ->assertJson(array_merge(
            $this->test_projects[0],
            [
                'id' => $first_project->id,
                'format_name' => 'JSON',
                'base_url' => $first_project->base_url,
                'key' => $first_project->key
            ]
        ));
    }

}
