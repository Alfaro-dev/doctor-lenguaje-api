<?php

namespace App\Services;

use App\Http\Responses\HttpStatus;
use App\Http\Responses\Response;
use App\Models\Module;

class ModuleService implements ModuleServiceInterface
{
    /**
     * Get all modules
     * 
     * @return Response
     */
    public function getAll() : Response
    {
        $modules = Module::with('lessons')->get();

        return new Response("", HttpStatus::OK, $modules);
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

        return new Response("Module created successfully", HttpStatus::CREATED, $module);
    }

    /**
     * Find a module by id
     * 
     * @param int $id
     * @return Response
     */
    public function findById(int $id): Response
    {
        $module = Module::with('lessons')->find($id);

        if (!$module) {
            return Response('Module not found', HttpStatus::NOT_FOUND);
        }

        return new Response($module);
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
            return new Response('Module not found', HttpStatus::NOT_FOUND);
        }

        $module->update($data);

        return new Response("Module updated successfully", HttpStatus::OK, $module);
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
            return new Response('Module not found', HttpStatus::NOT_FOUND);
        }

        $module->delete();

        return new Response("Module deleted successfully", HttpStatus::OK);
    }
}