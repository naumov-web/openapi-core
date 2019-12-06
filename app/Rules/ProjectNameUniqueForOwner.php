<?php

namespace App\Rules;

use App\Repositories\ProjectsRepository;
use App\Services\ProjectsService;
use Illuminate\Contracts\Validation\Rule;

/**
 * Class ProjectNameUniqueForOwner
 * @package App\Rules
 */
class ProjectNameUniqueForOwner implements Rule
{
    /**
     * Projects service instance
     * @var ProjectsService
     */
    protected $service;

    /**
     * Except id
     * @var null
     */
    protected $except_id = null;

    /**
     * Create a new rule instance.
     * @param int|null $except_id
     */
    public function __construct(int $except_id = null)
    {
        $this->except_id = $except_id;
        $this->service = new ProjectsService(new ProjectsRepository());
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $owner = auth()->user()->abstract_owner;

        return !(
            $this->service->isProjectExists(
                $value,
                $owner->id,
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
        return config('error_messages.project_name_unique_for_owner');
    }
}
