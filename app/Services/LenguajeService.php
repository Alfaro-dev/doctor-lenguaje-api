<?php

namespace App\Services;

use App\Models\Lenguaje;
use App\Http\Resources\LenguajeResource;
use App\Http\Responses\Response;

class LenguajeService implements LenguajeServiceInterface
{
    /**
     * Get all lenguajes
     * 
     * @return Response
     */
    public function getAll() : Response
    {
        $lenguajes = Lenguaje::all();

        $collection = LenguajeResource::collection($lenguajes);

        return Response::success($collection);
    }

    /**
     * Create a new lenguaje
     * 
     * @param array $data
     * @return Response
     */

    public function create(array $data): Response
    {
        $lenguaje = Lenguaje::create($data);

        $collection = new LenguajeResource($lenguaje);

        return Response::created($collection, 'Lenguaje created successfully');
    }

    /**
     * Find a lenguaje by id
     * 
     * @param int $id
     * @return Response
     */

    public function findById(int $id): Response
    {
        $lenguaje = Lenguaje::find($id);

        if (!$lenguaje) {
            return Response::notFound('Lenguaje not found');
        }

        $collection = new LenguajeResource($lenguaje);

        return Response::success($collection);
    }

    /**
     * Update a lenguaje
     * 
     * @param int $id
     * @param array $data
     * @return Response
     */

    public function update(int $id, array $data): Response
    {
        $lenguaje = Lenguaje::find($id);

        if (!$lenguaje) {
            return Response::notFound('Lenguaje not found');
        }

        $lenguaje->update($data);

        $collection = new LenguajeResource($lenguaje);

        return Response::updated($collection, 'Lenguaje updated successfully');
    }

    /**
     * Delete a lenguaje
     * 
     * @param int $id
     * @return Response
     */
    public function delete(int $id): Response
    {
        $lenguaje = Lenguaje::find($id);

        if (!$lenguaje) {
            return Response::notFound('Lenguaje not found');
        }

        $lenguaje->delete();

        return Response::deleted('Lenguaje deleted successfully');
    }
}
