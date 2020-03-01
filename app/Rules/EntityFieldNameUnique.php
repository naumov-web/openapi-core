<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Class EntityFieldNameUnique
 * @package App\Rules
 */
class EntityFieldNameUnique implements Rule
{

    /**
     * @inheritDoc
     */
    public function passes($attribute, $value)
    {
        $names = [];
        $result = true;

        foreach ($value as $item) {
            if (in_array($item['name'], $names)) {
                $result = false;
            }

            $names[] = $item['name'];
        }

        return $result;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return config('error_messages.entity_fields_unique');
    }
}
