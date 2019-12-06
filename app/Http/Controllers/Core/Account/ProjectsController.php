<?php

namespace App\Http\Controllers\Core\Account;

use App\Http\Requests\Core\Account\Projects\CreateProjectRequest;
use App\Http\Requests\Core\Account\Projects\GetProjectsRequest;
use App\Http\Requests\Core\Account\Projects\UpdateProjectRequest;
use App\Http\Resources\Account\ListResource;
use App\Http\Resources\Account\Projects\ProjectDetailResource;
use App\Http\Resources\Account\Projects\ProjectResource;
use App\Models\Project;
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
     * Get projects list
     *
     * @param GetProjectsRequest $request
     * @return ListResource
     */
    public function index(GetProjectsRequest $request): ListResource
    {
        $owner = auth()->user()->abstract_owner;
        $result = $this->service->list($owner, $request->all());

        return new ListResource(
            ProjectResource::class,
            $result->getModels(),
            $result->getCount()
        );
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
            $owner,
            $request->all()
        );

        return response()->json([
           'success' => true
        ]);
    }

    /**
     * Update request
     *
     * @param Project $project
     * @param UpdateProjectRequest $request
     * @return JsonResponse
     */
    public function update(Project $project, UpdateProjectRequest $request): JsonResponse
    {
        $this->service->update(
            $project,
            $request->all()
        );

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Get project detailed info
     *
     * @param Project $project
     * @return ProjectDetailResource
     */
    public function show(Project $project): ProjectDetailResource
    {
        return new ProjectDetailResource(
            $this->service->showModel($project)
        );
    }

}
