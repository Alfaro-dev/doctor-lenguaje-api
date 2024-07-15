<?php

namespace App\Services;

use App\Models\User;

interface UserServiceInterface
{
    public function create(array $newUserData): User;
    public function findById(int $id): ?User;
    public function findByEmail(string $email): ?User;
}
