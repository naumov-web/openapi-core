<?php

namespace App\Repositories;

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
    protected abstract function getModelClass() : string;

}
