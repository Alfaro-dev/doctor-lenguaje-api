<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

use App\Services\LearningProgressServiceInterface;

class LearningProgressController extends Controller
{
    protected $learningProgressService;

    public function __construct(LearningProgressServiceInterface $learningProgressService)
    {
        $this->learningProgressService = $learningProgressService;
    }


    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $learningProgressResponse = $this->learningProgressService->index();

        return $learningProgressResponse->getJsonResponse();
    }
}
