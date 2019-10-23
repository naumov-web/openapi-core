<?php

namespace App\Services;

use App\Repositories\AbstractRepository;
use Illuminate\Database\Eloquent\Model;

/**
 * Class AbstractEntityService
 * @package App\Services
 */
abstract class AbstractEntityService
{

    /**
     * Get repository instance
     *
     * @return AbstractRepository
     */
    abstract protected function getRepository() : AbstractRepository;

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
