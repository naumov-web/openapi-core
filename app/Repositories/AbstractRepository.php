<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * Class AbstractRepository
 * @package App\Repositories
 */
abstract class AbstractRepository
{

    /**
     * Get model class name
     *
     * @return string
     */
    protected abstract function getModelClass(): string;

    /**
     * Store new model to database
     *
     * @param array $data
     * @return Model
     */
    public function store(array $data): Model
    {
        $model_class = $this->getModelClass();

        /**
         * @var Model $model
         */
        $model = new $model_class();
        $model->fill($data);
        $model->save();

        return $model;
    }

    /**
     * Update model
     *
     * @param Model $model
     * @param array $data
     * @return Model
     */
    public function update(Model $model, array $data): Model
    {
        $model->fill($data);
        $model->save();

        return $model;
    }

    /**
     * Get first model by simple filters
     *
     * @param array $filters
     * @return Model|null
     */
    public function getFirstByFilters(array $filters): ?Model
    {
        $model_class = $this->getModelClass();

        /**
         * @var Builder
         */
        $query = $model_class::query();

        foreach($filters as $filter) {
            if (count($filter) == 2) {
                $query->where($filter[0], $filter[1]);
            }
        }

        return $query->first();
    }

}
