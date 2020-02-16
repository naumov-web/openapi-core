<?php

namespace App\Services;

/**
 * Class HandbookService
 * @package App\Services
 */
class HandbookService extends AbstractService
{

    /**
     * Get all handbooks
     *
     * @return array
     */
    public function index()
    {
        return [
            'formats' => $this->getFormats(),
            'field_types' => $this->getFieldTypes(),
        ];
    }

    /**
     * Get available api formats
     *
     * @return array
     */
    public function getFormats(): array
    {
        return config('handbooks.formats');
    }

    /**
     * Get field types
     *
     * @return array
     */
    public function getFieldTypes(): array
    {
        return config('handbooks.field_types');
    }

}
