<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

use App\Services\LevelServiceInterface;

use App\Http\Requests\StoreLevelRequest;
use App\Http\Requests\UpdateLevelRequest;

class LevelController extends Controller
{
    protected LevelServiceInterface $levelService;

    public function __construct(LevelServiceInterface $levelService)
    {
        $this->levelService = $levelService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse
    {
        $levels = $this->levelService->getAll();
        return $levels->getJsonResponse();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLevelRequest $request) : JsonResponse
    {
        $level = $this->levelService->create($request->all());
        return $level->getJsonResponse();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) : JsonResponse
    {
        $level = $this->levelService->findById((int) $id);
        return $level->getJsonResponse();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLevelRequest $request, string $id) : JsonResponse
    {
        $level = $this->levelService->update((int) $id, $request->all());
        return $level->getJsonResponse();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : JsonResponse
    {
        $level = $this->levelService->delete((int) $id);
        return $level->getJsonResponse();
    }
}
