<?php

namespace App\Services;

use Exception;
use App\Http\Responses\HttpStatus;
use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\RegisterAuthRequest;
use App\Http\Resources\UserResource;
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
        try {
            $user = $this->userService->create($request->all());

            if ($user === null) {
                throw new Exception('User not created');
            }

            return Response::created(new UserResource($user), 'User Created Successfully');

        } catch (Exception $e) {
            return Response::error($e->getMessage());
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
        try {

            $email = $request->input('email');
            $password = $request->input('password');
            $remenberMe = $request->has('remember_me') ? $request->input('remember_me') : false;

            if (!Auth::attempt(['email' => $email, 'password' => $password], $remenberMe)) {
                return Response::unauthorized('Invalid credentials');
            }
    
            $user = $this->userService->findByEmail($email);
    
            $token = $user->createToken(
                'auth_token'
            )->plainTextToken;

            return Response::accepted(
                'Logged in successfully',
                [
                    'token' => $token,
                    'token_type' => 'Bearer',
                    'user' => new UserResource($user)
                ]
            );
        } catch (Exception $e) {
            return Response::error($e->getMessage());
        }
    }

    /**
     * Logout a user
     *
     * @return Response
     */
    public function logout(): Response
    {
        try {
            $user = $this->userService->findById(Auth::user()->id);
            $user->tokens()->delete();
    
            return Response::success(null, 'User logged out');
        } catch (Exception $e) {
            return Response::error($e->getMessage());
        }
    }
}