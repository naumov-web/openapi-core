<?php

namespace App\Http\Controllers\Core\Account;

use App\Http\Requests\Core\Account\ProjectEntities\CreateProjectEntityRequest;
use App\Http\Requests\Core\Account\ProjectEntities\GetProjectEntitiesRequest;
use App\Http\Resources\Account\ListResource;
use App\Http\Resources\Account\ProjectEntities\ProjectEntityResource;
use App\Models\Project;
use App\Services\ProjectEntitiesService;
use Illuminate\Http\JsonResponse;

/**
 * Class ProjectEntitiesController
 * @package App\Http\Controllers\Core\Account
 */
class ProjectEntitiesController extends AbstractAccountController
{

    /**
     * Project entities service instance
     * @var ProjectEntitiesService
     */
    protected $service;

    /**
     * ProjectEntitiesController constructor.
     * @param ProjectEntitiesService $service
     */
    public function __construct(ProjectEntitiesService $service)
    {
        $this->service = $service;
    }

    /**
     * Create new project entity
     *
     * @param Project $project
     * @param CreateProjectEntityRequest $request
     * @return JsonResponse
     */
    public function create(Project $project, CreateProjectEntityRequest $request): JsonResponse
    {
        $this->service->create($project, $request->all());

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Get project entities list
     *
     * @param Project $project
     * @param GetProjectEntitiesRequest $request
     * @return ListResource
     */
    public function index(Project $project, GetProjectEntitiesRequest $request): ListResource
    {
        $result = $this->service->list(
            $project,
            $request->all()
        );

        return new ListResource(
            ProjectEntityResource::class,
            $result->getModels(),
            $result->getCount()
        );
    }
}
