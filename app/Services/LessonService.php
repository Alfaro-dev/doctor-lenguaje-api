<?php

namespace App\Services;

use App\Http\Responses\HttpStatus;
use App\Http\Responses\Response;
use App\Models\Lesson;

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

        return new Response("", HttpStatus::OK, $lessons);
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

        return new Response("Lesson created successfully", HttpStatus::CREATED, $lesson);
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
            return Response('Lesson not found', HttpStatus::NOT_FOUND);
        }

        return new Response($lesson);
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
            return Response('Lesson not found', HttpStatus::NOT_FOUND);
        }

        $lesson->update($data);

        return new Response("Lesson updated successfully", HttpStatus::OK, $lesson);
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
            return Response('Lesson not found', HttpStatus::NOT_FOUND);
        }

        $lesson->delete();

        return new Response("Lesson deleted successfully", HttpStatus::OK);
    }
}