<?php

namespace App\Services;

use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\RegisterAuthRequest;
use App\Http\Responses\Response;

interface AuthServiceInterface
{
    public function register(RegisterAuthRequest $request): Response;
    public function login(LoginAuthRequest $request): Response;
    public function me(): Response;
    public function logout(): Response;
}
