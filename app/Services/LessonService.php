<?php

namespace App\Services;

use App\Models\Lesson;
use App\Http\Resources\LessonResource;
use App\Http\Responses\Response;

class LessonService implements LessonServiceInterface
{
    /**
     * Get all lessons
     * 
     * @return Response
     */
    public function getAll() : Response
    {
        $lessons = Lesson::all();

        $collection = LessonResource::collection($lessons);

        return Response::success($collection);
    }

    /**
     * Create a new lesson
     * 
     * @param array $data
     * @return Response
     */
    public function create(array $data): Response
    {
        $lesson = Lesson::create($data);

        $collection = new LessonResource($lesson);

        return Response::created($collection, 'Lesson created successfully');
    }

    /**
     * Find a lesson by id
     * 
     * @param int $id
     * @return Response
     */
    public function findById(int $id): Response
    {
        $lesson = Lesson::find($id);

        if (!$lesson) {
            return Response::notFound('Lesson not found');
        }

        $collection = new LessonResource($lesson);

        return Response::success($collection);
    }

    /**
     * Update a lesson
     * 
     * @param int $id
     * @param array $data
     * @return Response
     */
    public function update(int $id, array $data): Response
    {
        $lesson = Lesson::find($id);

        if (!$lesson) {
            return Response::notFound('Lesson not found');
        }

        $lesson->update($data);

        $collection = new LessonResource($lesson);

        return Response::updated($collection, 'Lesson updated successfully');
    }

    /**
     * Delete a lesson
     * 
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        $lesson = Lesson::find($id);

        if (!$lesson) {
            return Response::notFound('Lesson not found');
        }

        $lesson->delete();

        return Response::deleted('Lesson deleted successfully');
    }
}