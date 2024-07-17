<?php

namespace App\Services;

use App\Models\Level;
use App\Http\Resources\LevelResource;
use App\Http\Responses\Response;

class LevelService implements LevelServiceInterface 
{
    /**
     * Get all levels
     * 
     * @return Response
     */
    public function getAll() : Response
    {
        $levels = Level::all();

        $collection = LevelResource::collection($levels);

        return Response::success($collection);
    }

    /**
     * Create a new level
     * 
     * @param array $data
     * @return Response
     */
    public function create(array $data): Response
    {
        $level = Level::create($data);

        $collection = new LevelResource($level);

        return Response::created($collection, 'Level created successfully');
    }

    /**
     * Find a level by id
     * 
     * @param int $id
     * @return Response
     */
    public function findById(int $id): Response
    {
        $level = Level::with('modules.lessons')->find($id);

        if (!$level) {
            return Response::notFound('Level not found');
        }

        $collection = new LevelResource($level);

        return Response::success($collection);
    }

    /**
     * Update a level
     * 
     * @param int $id
     * @param array $data
     * @return Response
     */
    public function update(int $id, array $data): Response
    {
        $level = Level::find($id);

        if (!$level) {
            return Response::notFound('Level not found');
        }

        $level->update($data);

        $collection = new LevelResource($level);

        return Response::updated($collection, 'Level updated successfully');
    }

    /**
     * Delete a level
     * 
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        $level = Level::find($id);

        if (!$level) {
            return Response::notFound('Level not found');
        }

        $level->delete();

        return Response::deleted('Level deleted successfully');
    }
}