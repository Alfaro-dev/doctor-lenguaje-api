<?php

namespace App\Services;

use App\Enums\ProgressStatus;
use App\Models\Experience;
use App\Models\Lesson;
use App\Models\Permission;
use App\Models\Progress;
use App\Models\Survey;
use App\Models\User;
use App\Services\UserServiceInterface;
use Illuminate\Support\Facades\Hash;

class UserService implements UserServiceInterface
{
    /**
     * Create a new user
     *
     * @param array $data
     * @return User
     */
    public function create(array $data): User
    {
        // Create the user
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        // Create a progress record for the first lesson
        $firstLesson = Lesson::where('order', 1)->first();

        Progress::create([
            'user_id' => $user->id,
            'lesson_id' => $firstLesson->id,
            'status' => ProgressStatus::NOT_STARTED,
        ]);

        // Create an experience record
        Experience::create([
            'user_id' => $user->id,
            'total_experience' => 0,
        ]);

        // Create a permission record for the first lesson
        Permission::create([
            'user_id' => $user->id,
            'lesson_id' => 1,
            'is_accessible' => true,
        ]);

        // Create a survey record
        Survey::create([
            'user_id' => $user->id,
            'reason' => $data['reason'],
            'time_commitment' => $data['time_commitment'],
            'current_level' => $data['current_level'],
        ]);

        return $user;
    }

    /**
     * Find a user by id
     *
     * @param int $id
     * @return User|null
     */
    public function findById(int $id): ?User {
        return User::with(['progress', 'experiences', 'permissions'])->find($id);
    }

    /**
     * Find a user by email
     *
     * @param string $email
     * @return User|null
     */
    public function findByEmail(string $email): ?User {
        return User::where('email', $email)->first();
    }
}
