<?php

namespace App\Services;

use App\Models\Project;
use App\Repositories\AbstractRepository;
use App\Repositories\ProjectEntitiesRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class ProjectEntitiesService
 * @package App\Services
 */
class ProjectEntitiesService extends AbstractEntityService
{

    /**
     * Project entities repository instance
     * @var ProjectEntitiesRepository
     */
    protected $repository;

    /**
     * ProjectEntitiesService constructor.
     * @param ProjectEntitiesRepository $repository
     */
    public function __construct(ProjectEntitiesRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @inheritDoc
     */
    protected function getRepository(): AbstractRepository
    {
        return $this->repository;
    }

    /**
     * Create project entity
     *
     * @param Project $project
     * @param array $data
     * @return Model
     */
    public function create(Project $project, array $data): Model
    {
        return $this->storeModel(
            array_merge(
                [
                    'project_id' => $project->id,
                ],
                $data
            )
        );
    }
}
