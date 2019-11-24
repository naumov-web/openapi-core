<?php

namespace App\Http\Controllers\Core\Account;

use App\Http\Requests\Core\Account\Projects\CreateProjectRequest;
use App\Services\ProjectsService;
use Illuminate\Http\JsonResponse;

/**
 * Class ProjectsController
 * @package App\Http\Controllers\Core\Account
 */
class ProjectsController extends AbstractAccountController
{
    /**
     * Projects service instance
     * @var ProjectsService
     */
    protected $service;

    /**
     * ProjectsController constructor.
     * @param ProjectsService $service
     */
    public function __construct(ProjectsService $service)
    {
        $this->service = $service;
    }

    /**
     * Create new project
     *
     * @param CreateProjectRequest $request
     * @return JsonResponse
     */
    public function create(CreateProjectRequest $request): JsonResponse
    {
        $owner = auth()->user()->abstract_owner;

        $this->service->create(
            array_merge(
                $request->all(),
                [
                    'owner_id' => $owner->id
                ]
            )
        );

        return response()->json([
           'success' => true
        ]);
    }

}
