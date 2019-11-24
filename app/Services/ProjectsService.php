<?php

namespace App\Services;

use App\Repositories\AbstractRepository;
use App\Repositories\ProjectsRepository;
use Illuminate\Database\Eloquent\Model;

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
     * Create new project
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        $full_key = sha1($data['name'] . $data['owner_id'] . microtime());
        $short_key = substr($full_key, 0, 10) . '-' . substr($full_key, 10, 10);

        return $this->store(
            array_merge(
                $data,
                [
                    'key' => $short_key
                ]
            )
        );
    }

    /**
     * Check is project exists for owner
     *
     * @param string $name
     * @param int $owner_id
     * @return bool
     */
    public function isProjectExists(string $name, int $owner_id): bool
    {
        return (bool)(
            $this->getRepository()->getFirstByFilters(
                [
                    ['name', $name],
                    ['owner_id', $owner_id]
                ]
            )
        );
    }
}
