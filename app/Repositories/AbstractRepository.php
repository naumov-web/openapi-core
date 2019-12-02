<?php

namespace App\Repositories;

use App\DTO\ListItemsDTO;
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
     * Apply filters to query
     *
     * @param Builder $query
     * @param array $filters
     * @return Builder
     */
    protected function applyFilters(Builder $query, array $filters): Builder
    {
        foreach($filters as $filter) {
            if (count($filter) == 2) {
                $query->where($filter[0], $filter[1]);
            }
        }

        return $query;
    }

    /**
     * Apply pagination to query
     *
     * @param Builder $query
     * @param array $data
     * @return Builder
     */
    protected function applyPagination(Builder $query, array $data): Builder
    {
        if (isset($data['limit'])) {
            $query->limit($data['limit']);
        }
        if (isset($data['offset'])) {
            $query->limit($data['offset']);
        }

        return $query;
    }

    /**
     * Get count and list of items
     *
     * @param array $data
     * @return ListItemsDTO
     */
    public function index(array $data): ListItemsDTO
    {
        $model_class = $this->getModelClass();

        /**
         * @var Builder $query
         */
        $query = $model_class::query();
        $count = $query->count();

        $query = $this->applyPagination($query, $data);

        return new ListItemsDTO($query->get(), $count);
    }

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
         * @var Builder $query
         */
        $query = $model_class::query();

        $query = $this->applyFilters($query, $filters);

        return $query->first();
    }

}
