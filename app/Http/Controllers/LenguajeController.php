<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;

use App\Services\LenguajeServiceInterface;

use App\Http\Requests\StoreLenguajeRequest;
use App\Http\Requests\UpdateLenguajeRequest;

class LenguajeController extends Controller
{
    protected $lenguajeService;

    public function __construct(LenguajeServiceInterface $lenguajeService)
    {
        $this->lenguajeService = $lenguajeService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index() : JsonResponse
    {
        $lenguajes = $this->lenguajeService->getAll();
        return $lenguajes->getJsonResponse();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLenguajeRequest $request) : JsonResponse
    {
        $lenguaje = $this->lenguajeService->create($request->all());
        return $lenguaje->getJsonResponse();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id) : JsonResponse
    {
        $lenguaje = $this->lenguajeService->findById((int) $id);
        return $lenguaje->getJsonResponse();
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLenguajeRequest $request, string $id) : JsonResponse
    {
        $lenguaje = $this->lenguajeService->update((int) $id, $request->all());
        return $lenguaje->getJsonResponse();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id) : JsonResponse
    {
        $lenguaje = $this->lenguajeService->delete((int) $id);
        return $lenguaje->getJsonResponse();
    }
}
