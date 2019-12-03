<?php

namespace Tests\Feature\Core\Account\Projects;

use Illuminate\Http\Response;

/**
 * Class GetProjectsTest
 * @package Tests\Feature\Core\Account\Projects
 */
class GetProjectsTest extends AbstractProjectTest
{
    /**
     * Check API, when we are using invalid data
     *
     * @test
     * @return void
     */
    public function testFail(): void
    {
        $this->json('GET', route('core.account.projects.index'))
            ->assertStatus(Response::HTTP_UNAUTHORIZED);

        $this->createTestAccount();
        $this->setSignedUser();

        $this->json('GET', route('core.account.projects.index'))
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->json('GET', route('core.account.projects.index', ['limit' => 1]))
            ->assertStatus(Response::HTTP_UNPROCESSABLE_ENTITY);

        $this->json('GET', route('core.account.projects.index', ['offset' => 1]))
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
        $this->createTestItems();

        // Case 1
        $request_params = [
            'limit' => 2,
            'offset' => 0
        ];
        $this->json('GET', route('core.account.projects.index', $request_params))
            ->assertOk()
            ->assertJson([
                'count' => count($this->test_projects),
                'items' => [
                    $this->test_projects[0],
                    $this->test_projects[1],
                ]
            ]);

        // Case 2
        $request_params['offset'] = 2;
        $this->json('GET', route('core.account.projects.index', $request_params))
            ->assertOk()
            ->assertJson([
                'count' => count($this->test_projects),
                'items' => [
                    $this->test_projects[2],
                    $this->test_projects[3],
                ]
            ]);

        // Case 3
        $request_params['sort_by'] = 'name';
        $request_params['sort_direction'] = 'desc';
        $this->json('GET', route('core.account.projects.index', $request_params))
            ->assertOk()
            ->assertJson([
                'count' => count($this->test_projects),
                'items' => [
                    $this->test_projects[1],
                    $this->test_projects[0],
                ]
            ]);

        // Case 4
        $request_params['sort_direction'] = 'asc';
        $this->json('GET', route('core.account.projects.index', $request_params))
            ->assertOk()
            ->assertJson([
                'count' => count($this->test_projects),
                'items' => [
                    $this->test_projects[2],
                    $this->test_projects[3],
                ]
            ]);

        // Case 5
        $request_params['offset'] = 0;
        $request_params['sort_by'] = 'format_id';
        $request_params['sort_direction'] = 'asc';

        $this->json('GET', route('core.account.projects.index', $request_params))
            ->assertOk()
            ->assertJson([
                'count' => count($this->test_projects),
                'items' => [
                    $this->test_projects[0],
                    $this->test_projects[3],
                ]
            ]);

        // Case 6
        $request_params['sort_direction'] = 'desc';
        $this->json('GET', route('core.account.projects.index', $request_params))
            ->assertOk()
            ->assertJsonCount(intval($request_params['limit']), 'items')
            ->assertJson([
                'count' => count($this->test_projects),
                'items' => [
                    $this->test_projects[1],
                    $this->test_projects[2],
                ]
            ]);
    }
}
