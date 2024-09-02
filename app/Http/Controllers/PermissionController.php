<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Responses\Response;
use Illuminate\Http\JsonResponse;

class PermissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse
    {
        return Response::notImplemented()->getJsonResponse();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return Response::notImplemented()->getJsonResponse();
    }

    /**
     * Display the specified resource.
     */
    public function show(Permission $permission)
    {
        return Response::notImplemented()->getJsonResponse();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Permission $permission)
    {
        return Response::notImplemented()->getJsonResponse();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Permission $permission)
    {
        return Response::notImplemented()->getJsonResponse();
    }
}
