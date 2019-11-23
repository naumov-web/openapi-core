<?php

namespace App\Http\Controllers\Core\Handbooks;

use App\Http\Controllers\Core\AbstractCoreController;
use App\Services\HandbookService;
use Illuminate\Http\JsonResponse;

/**
 * Class PublicController
 * @package App\Http\Controllers\Core\Handbooks
 */
class PublicController extends AbstractCoreController
{

    /**
     * Handbook service instance
     * @var HandbookService
     */
    protected $handbooks_service;

    /**
     * PublicController constructor.
     * @param HandbookService $handbooks_service
     */
    public function __construct(HandbookService $handbooks_service)
    {
        $this->handbooks_service = $handbooks_service;
    }

    /**
     * Get all handbooks
     *
     * @return JsonResponse
     */
    public function all()
    {
        return response()->json(
            $this->handbooks_service->index()
        );
    }

}
