<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

use App\Services\LessonServiceInterface;

use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;

class LessonController extends Controller
{
    protected $lessonService;

    public function __construct(LessonServiceInterface $lessonService)
    {
        $this->lessonService = $lessonService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse
    {
        $lessons = $this->lessonService->getAll();
        return $lessons->getJsonResponse();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLessonRequest $request) : JsonResponse
    {
        $lesson = $this->lessonService->create($request->all());
        return $lesson->getJsonResponse();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) : JsonResponse
    {
        $lesson = $this->lessonService->findById((int) $id);
        return $lesson->getJsonResponse();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLessonRequest $request, string $id) : JsonResponse
    {
        $lesson = $this->lessonService->update((int) $id, $request->all());
        return $lesson->getJsonResponse();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : JsonResponse
    {
        $lesson = $this->lessonService->delete((int) $id);
        return $lesson->getJsonResponse();
    }
}
