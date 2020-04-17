<?php

namespace App\Services;

use App\DTO\ListItemsDTO;
use App\Models\Project;
use App\Models\ProjectEntity;
use App\Repositories\AbstractRepository;
use App\Repositories\ProjectEntitiesRepository;
use App\Repositories\ProjectEntityFieldsRepository;
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
     * Project entity fields service instance
     * @var ProjectEntityFieldsService
     */
    protected $project_entity_fields_service;

    /**
     * ProjectEntitiesService constructor.
     * @param ProjectEntitiesRepository $repository
     */
    public function __construct(ProjectEntitiesRepository $repository)
    {
        $this->repository = $repository;
        $this->project_entity_fields_service = new ProjectEntityFieldsService(
            new ProjectEntityFieldsRepository()
        );
    }

    /**
     * @inheritDoc
     */
    protected function getRepository(): AbstractRepository
    {
        return $this->repository;
    }

    /**
     * Get project entities list
     *
     * @param Project $project
     * @param array $data
     * @return ListItemsDTO
     */
    public function list(Project $project, array $data): ListItemsDTO
    {
        return $this->indexModels(
            array_merge(
                $data,
                [
                    'filters' => [
                        ['project_id', $project->id],
                    ]
                ]
            )
        );
    }

    /**
     * Create project entity
     *
     * @param Project $project
     * @param array $data
     * @return ProjectEntity
     */
    public function create(Project $project, array $data): ProjectEntity
    {
        /**
         * @var ProjectEntity $entity
         */
        $entity = $this->storeModel(
            array_merge(
                [
                    'project_id' => $project->id,
                ],
                $data
            )
        );

        if (isset($data['fields'])) {
            $this->project_entity_fields_service->createMultiple(
                $entity,
                $data['fields']
            );
        }

        return $entity;
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
