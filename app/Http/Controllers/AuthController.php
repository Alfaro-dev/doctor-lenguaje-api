<?php
   
namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

use App\Services\AuthServiceInterface;

use App\Http\Requests\LoginAuthRequest;
use App\Http\Requests\RegisterAuthRequest;
   
class AuthController extends Controller
{
    protected AuthServiceInterface $authServiceInterface;

    public function __construct(AuthServiceInterface $authServiceInterface)
    {
        $this->authServiceInterface = $authServiceInterface;
    }

    /**
     * Register api
     * @param RegisterAuthRequest $request
     * @return JsonResponse
     */
    public function register(RegisterAuthRequest $request): JsonResponse
    {
        $registerUserResponse = $this->authServiceInterface->register($request);
        return $registerUserResponse->getJsonResponse();
    }
   
    /**
     * Login api
     * @param LoginAuthRequest $request
     * @return JsonResponse
     */
    public function login(LoginAuthRequest $request): JsonResponse
    {
        $loginUserResponse = $this->authServiceInterface->login($request);
        return $loginUserResponse->getJsonResponse(); 
    }

    /**
     * Me api
     * @return JsonResponse
     */
    public function me(): JsonResponse
    {
        $meUserResponse = $this->authServiceInterface->me();
        return $meUserResponse->getJsonResponse();
    }

    /**
     * Logout api
     * @return JsonResponse
     */
    public function logout(): JsonResponse
    {
        $logoutUserResponse = $this->authServiceInterface->logout();
        return $logoutUserResponse->getJsonResponse();
    }
}