<?php

namespace App\Rules;

use App\Repositories\ProjectEntitiesRepository;
use App\Services\ProjectEntitiesService;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class EntityNameUniqueForProject
 * @package App\Rules
 */
class EntityNameUniqueForProject implements Rule
{

    /**
     * Project entities service
     * @var ProjectEntitiesService
     */
    protected $service;

    /**
     * Except id
     * @var null
     */
    protected $except_id = null;

    /**
     * Project id
     * @var null
     */
    protected $project_id = null;

    /**
     * EntityNameUniqueForProject constructor.
     * @param int $project_id
     * @param int|null $except_id
     */
    public function __construct(int $project_id, int $except_id = null)
    {
        $this->project_id = $project_id;
        $this->except_id = $except_id;
        $this->service = new ProjectEntitiesService(new ProjectEntitiesRepository());
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param string $attribute
     * @param mixed $value
     * @return bool
     */
    public function passes($attribute, $value): bool
    {
        return !(
            $this->service->isEntityExists(
                $value,
                $this->project_id,
                $this->except_id
            )
        );
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return config('error_messages.project_entity_unique_for_project');
    }
}
