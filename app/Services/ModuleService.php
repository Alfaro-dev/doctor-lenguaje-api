<?php

namespace App\Services;

use App\Models\Module;
use App\Http\Resources\ModuleResource;
use App\Http\Responses\Response;

class ModuleService implements ModuleServiceInterface
{
    /**
     * Get all modules
     * 
     * @return Response
     */
    public function getAll() : Response
    {
        $modules = Module::with('level')->with('lessons')->get();

        $collection = ModuleResource::collection($modules);

        return Response::success($collection);
    }

    /**
     * Create a new module
     * 
     * @param array $data
     * @return Response
     */
    public function create(array $data): Response
    {
        $module = Module::create($data);

        $collection = new ModuleResource($module);

        return Response::created($collection, 'Module created successfully');
    }

    /**
     * Find a module by id
     * 
     * @param int $id
     * @return Response
     */
    public function findById(int $id): Response
    {
        $module = Module::with('level')->with('lessons')->find($id);

        if (!$module) {
            return Response::notFound('Module not found');
        }

        $collection = new ModuleResource($module);

        return Response::success($collection);
    }

    /**
     * Update a module
     * 
     * @param int $id
     * @param array $data
     * @return Response
     */
    public function update(int $id, array $data): Response
    {
        $module = Module::find($id);

        if (!$module) {
            return Response::notFound('Module not found');
        }

        $module->update($data);

        $collection = new ModuleResource($module);

        return Response::updated($collection, 'Module updated successfully');
    }

    /**
     * Delete a module
     * 
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        $module = Module::find($id);

        if (!$module) {
            return Response::notFound('Module not found');
        }

        $module->delete();

        return Response::deleted('Module deleted successfully');
    }
}