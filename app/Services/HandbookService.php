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

}
