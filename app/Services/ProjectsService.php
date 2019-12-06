<?php

namespace App\Services;

use App\DTO\ListItemsDTO;
use App\Models\Owner;
use App\Models\Project;
use App\Repositories\AbstractRepository;
use App\Repositories\ProjectsRepository;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

/**
 * Class ProjectsService
 * @package App\Services
 */
class ProjectsService extends AbstractEntityService
{
    /**
     * Projects repository instance
     * @var ProjectsRepository
     */
    protected $repository;

    /**
     * ProjectsService constructor.
     * @param ProjectsRepository $repository
     */
    public function __construct(ProjectsRepository $repository)
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
     * Get list of projects by owner
     *
     * @param Owner $owner
     * @param array $data
     * @return ListItemsDTO
     */
    public function list(Owner $owner, array $data): ListItemsDTO
    {
        return $this->indexModels(
            array_merge(
                $data,
                [
                    'filters' => [
                        ['owner_id', $owner->id],
                    ]
                ]
            )
        );
    }

    /**
     * Create new project
     *
     * @param Owner $owner
     * @param array $data
     * @return Model
     */
    public function create(Owner $owner, array $data): Model
    {
        $full_key = sha1($data['name'] . $owner->id . microtime());
        $short_key = substr($full_key, 0, 10) . '-' . substr($full_key, 10, 10);

        return $this->storeModel(
            array_merge(
                $data,
                [
                    'key' => $short_key,
                    'owner_id' => $owner->id,
                ]
            )
        );
    }

    /**
     * Update project
     *
     * @param Project $model
     * @param array $data
     * @return Model
     */
    public function update(Project $model, array $data): Model
    {
        return $this->updateModel(
            $model,
            Arr::only(
                $data,
                [
                    'name',
                    'description',
                    'format_id'
                ]
            )
        );
    }

    /**
     * Check is project exists for owner
     *
     * @param string $name
     * @param int $owner_id
     * @param int|null $except_id
     * @return bool
     */
    public function isProjectExists(string $name, int $owner_id, int $except_id = null): bool
    {
        $filters = [
            ['name', $name],
            ['owner_id', $owner_id]
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
