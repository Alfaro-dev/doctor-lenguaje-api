<?php

namespace App\Services;

use App\Http\Responses\Response;

interface ModuleServiceInterface
{
    public function getAll(): Response;
    public function create(array $data): Response;
    public function findById(int $id): Response;
    public function update(int $id, array $data): Response;
    public function delete(int $id): Response;
}