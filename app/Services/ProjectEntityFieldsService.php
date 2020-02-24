<?php

namespace App\Services;

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
}
