<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

use App\Services\ModuleServiceInterface;

use App\Http\Requests\StoreModuleRequest;
use App\Http\Requests\UpdateModuleRequest;

class ModuleController extends Controller
{
    protected $moduleService;

    public function __construct(ModuleServiceInterface $moduleService)
    {
        $this->moduleService = $moduleService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse
    {
        $modules = $this->moduleService->getAll();
        return $modules->getJsonResponse();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreModuleRequest $request) : JsonResponse
    {
        $module = $this->moduleService->create($request->all());
        return $module->getJsonResponse();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) : JsonResponse
    {
        $module = $this->moduleService->findById((int) $id);
        return $module->getJsonResponse();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateModuleRequest $request, string $id) : JsonResponse
    {
        $module = $this->moduleService->update((int) $id, $request->all());
        return $module->getJsonResponse();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : JsonResponse
    {
        $module = $this->moduleService->delete((int) $id);
        return $module->getJsonResponse();
    }
}
