<?php

namespace App\Services;

use App\Http\Resources\LearningProgressResource;
use App\Http\Responses\Response;
use App\Models\Lesson;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class LearningProgressService implements LearningProgressServiceInterface
{
    public function index(): Response
    {
        try {
            $userId = Auth::id();

            $user = User::with(['progress', 'permissions'])->findOrFail($userId);

            $currentLesson = $user->progress() ->where('status', '!=', 'completed')->first();

            $currentModule = $currentLesson->lesson->module;

            $lessons = $currentModule->id ? Lesson::where('module_id', $currentModule->id)
                ->get()
                ->map(function ($lesson) use ($user) {
                    return new LearningProgressResource([
                        'lesson' => $lesson,
                        'is_accessible' => $user->permissions
                            ->where('lesson_id', $lesson->id)
                            ->first()
                            ->is_accessible ?? false,
                        'status' => $user->progress
                            ->where('lesson_id', $lesson->id)
                            ->first()
                            ->status ?? 'not_started',
                    ]);
                }) : [];

            return Response::success($lessons);
        } catch (\Exception $e) {
            return Response::error($e->getMessage());
        }
    }
}