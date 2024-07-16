<?php
    namespace App\Services;

use App\Http\Responses\HttpStatus;
use App\Http\Responses\Response;
use App\Models\Level;

class LevelService implements LevelServiceInterface 
{
    /**
     * Get all levels
     * 
     * @return Response
     */
    public function getAll() : Response
    {
        $levels = Level::with('modules.lessons')->get();

        return new Response("", HttpStatus::OK, $levels);
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

        return new Response($level, HttpStatus::CREATED);
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
            return Response('Level not found', HttpStatus::NOT_FOUND);
        }

        return new Response($level);
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
            return Response('Level not found', HttpStatus::NOT_FOUND);
        }

        $level->update($data);

        return new Response($level);
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
            return Response('Level not found', HttpStatus::NOT_FOUND);
        }

        $level->delete();

        // retornar que se eleimino satifactoriamente
        return new Response('Deleted successfully', HttpStatus::OK);
    }
}