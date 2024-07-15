<?php

namespace App\Services;

use Exception;
use App\Http\Responses\HttpStatus;
use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\RegisterAuthRequest;
use App\Http\Responses\ErrorResponse;
use App\Http\Responses\Response;
use Illuminate\Support\Facades\Auth;

class AuthService implements AuthServiceInterface
{
    protected UserServiceInterface $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
    }

    /**
     * Register a new user
     *
     * @param RegisterAuthRequest $request
     * @return Response
     */
    public function register(RegisterAuthRequest $request): Response
    {
        if (!$request->validated()) {
            return new ErrorResponse(
                'Invalid Request',
                HttpStatus::BAD_REQUEST,
                $request->errors(),
            );
        }

        try {
            $user = $this->userService->create($request->all());

            if ($user === null) {
                throw new Exception('User not created');
            }

            return new Response(
                'User Created Successfully',
                HttpStatus::CREATED,
                ['message' => 'User created successfully']
            );
        } catch (Exception $e) {
            return new ErrorResponse(
                $e->getMessage(),
                HttpStatus::INTERNAL_SERVER_ERROR
            );
        }
    }

    /**
     * Login a user
     *
     * @param LoginAuthRequest $request
     * @return Response
     */
    public function login(LoginAuthRequest $request): Response
    {
        if (!$request->validated()) {
            return new ErrorResponse(
                'Invalid Request',
                HttpStatus::BAD_REQUEST,
                $request->errors(),
            );
        }

        if (!Auth::attempt($request->only('email', 'password'))) {
            return new ErrorResponse(
                'User not recognized',
                HttpStatus::UNAUTHORIZED
            );
        }

        $user = $this->userService->findByEmail($request->input('email'));

        $token = $user->createToken(
            'auth_token'
        )->plainTextToken;

        return new Response('Logged In!', HttpStatus::ACCEPTED, [
            'token' => $token,
            'token_type' => 'Bearer'
        ]);
    }

    /**
     * Logout a user
     *
     * @return Response
     */
    public function logout(): Response
    {
        $user = $this->userService->findById(Auth::user()->id);
        $user->tokens()->delete();

        return new Response('User logged out');
    }
}