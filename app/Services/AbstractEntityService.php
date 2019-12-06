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
    public function indexModels(array $data): ListItemsDTO
    {
        return $this->getRepository()->index($data);
    }

    /**
     * Get detailed model info
     *
     * @param Model $model
     * @return Model
     */
    public function showModel(Model $model): Model
    {
        return $this->getRepository()->show($model);
    }

    /**
     * Store new entity
     *
     * @param array $data
     * @return Model
     */
    public function storeModel(array $data) : Model
    {
        $repository = $this->getRepository();

        return $repository->store($data);
    }

    /**
     * Update model
     *
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function updateModel(Model $model, array $data): Model
    {
        $repository = $this->getRepository();

        return $repository->update($model, $data);
    }

    /**
     * Delete model
     *
     * @param Model $model
     * @return bool
     * @throws \Exception
     */
    public function deleteModel(Model $model): bool
    {
        $repository = $this->getRepository();

        return $repository->delete($model);
    }

}
