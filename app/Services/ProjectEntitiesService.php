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

    /**
     * Check is entity exists for project
     *
     * @param string $name
     * @param int $project_id
     * @param int|null $except_id
     * @return bool
     */
    public function isEntityExists(string $name, int $project_id, int $except_id = null): bool
    {
        $filters = [
            ['name', $name],
            ['project_id', $project_id]
        ];

        if ($except_id) {
            $filters[] = [
                'id',
                '<>',
                $except_id
            ];
        }

        return (bool)(
            $this->getRepository()->getFirstByFilters(
                $filters
            )
        );
    }
}
