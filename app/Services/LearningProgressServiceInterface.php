<?php

namespace App\Services;

use App\Http\Responses\Response;

interface LearningProgressServiceInterface
{
    public function index(): Response;
}