<?php

namespace App\Services;

use App\Models\ProjectEntity;
use App\Models\ProjectEntityField;
use App\Repositories\AbstractRepository;
use App\Repositories\ProjectEntityFieldsRepository;

/**
 * Class ProjectEntityFieldsService
 * @package App\Services
 */
class ProjectEntityFieldsService extends AbstractEntityService
{

    /**
     * Project entity fields repository instance
     * @var ProjectEntityFieldsRepository
     */
    protected $repository;

    /**
     * ProjectEntityFieldsService constructor.
     * @param ProjectEntityFieldsRepository $repository
     */
    public function __construct(ProjectEntityFieldsRepository $repository)
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
     * Create multiple fields
     *
     * @param ProjectEntity $model
     * @param array $items
     * @return void
     */
    public function createMultiple(ProjectEntity $model, array $items): void
    {
        foreach ($items as $item) {
            $this->create($model, $item);
        }
    }

    /**
     * Create project entity field
     *
     * @param ProjectEntity $model
     * @param array $data
     * @return ProjectEntityField
     */
    public function create(ProjectEntity $model, array $data): ProjectEntityField
    {
        /**
         * @var ProjectEntityField $model
         */
        $model = $this->storeModel(
            array_merge(
                [
                    'project_entity_id' => $model->id,
                ]
            )
        );

        return $model;
    }

}
