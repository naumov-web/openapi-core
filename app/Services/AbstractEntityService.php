<?php

namespace App\Services;

use App\DTO\ListItemsDTO;
use App\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AbstractEntityService
 * @package App\Services
 */
abstract class AbstractEntityService extends AbstractService
{

    /**
     * Get repository instance
     *
     * @return AbstractRepository
     */
    abstract protected function getRepository() : AbstractRepository;

    /**
     * @param array $data
     * @return ListItemsDTO
     */
    public function index(array $data): ListItemsDTO
    {
        return $this->getRepository()->index($data);
    }

    /**
     * Get detailed model info
     *
     * @param Model $model
     * @return Model
     */
    public function show(Model $model): Model
    {
        return $this->getRepository()->show($model);
    }

    /**
     * Store new entity
     *
     * @param array $data
     * @return Model
     */
    public function store(array $data) : Model
    {
        $repository = $this->getRepository();

        return $repository->store($data);
    }

}
