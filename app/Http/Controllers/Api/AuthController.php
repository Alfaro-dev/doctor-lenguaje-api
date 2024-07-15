<?php
   
namespace App\Http\Controllers\API;
   
use App\Http\Controllers\Controller;
use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\RegisterAuthRequest;
use App\Services\AuthService;
use Illuminate\Http\JsonResponse;
   
class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    /**
     * Register api
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(RegisterAuthRequest $request): JsonResponse
    {
        $registerUserResponse = $this->authService->register($request);
        return $registerUserResponse->getJsonResponse();
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginAuthRequest $request): JsonResponse
    {
        $loginUserResponse = $this->authService->login($request);
        return $loginUserResponse->getJsonResponse(); 
    }

    /**
     * Logout api
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(): JsonResponse
    {
        $logoutUserResponse = $this->authService->logout();
        return $logoutUserResponse->getJsonResponse();
    }
}