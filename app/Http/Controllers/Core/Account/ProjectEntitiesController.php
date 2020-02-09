<?php

namespace App\Http\Controllers\Core\Account;

use App\Http\Requests\Core\Account\ProjectEntities\CreateProjectEntityRequest;
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
        return response()->json([
            'success' => true
        ]);
    }
}
