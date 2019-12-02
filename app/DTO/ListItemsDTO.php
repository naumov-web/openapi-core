<?php

namespace App\DTO;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * Class ListItemsDTO
 * @package App\DTO
 */
class ListItemsDTO
{

    /**
     * Count of all items
     * @var int
     */
    protected $count;

    /**
     * Collection of models
     * @var Collection
     */
    protected $models;

    /**
     * ListItemsDTO constructor.
     * @param Collection $models
     * @param int $count
     */
    public function __construct(Collection $models, int $count)
    {
        $this->models = $models;
        $this->count = $count;
    }

    /**
     * Get models
     *
     * @return Collection
     */
    public function getModels(): Collection
    {
        return $this->models;
    }

    /**
     * Get count
     *
     * @return int
     */
    public function getCount(): int
    {
        return $this->count;
    }

}
