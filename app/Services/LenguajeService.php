<?php

namespace App\Services;

use App\Http\Resources\LenguajeResource;
use App\Http\Responses\HttpStatus;
use App\Http\Responses\Response;
use App\Models\Lenguaje;

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

        // add reason and status to the response
        return new Response("", HttpStatus::OK, $collection);
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

        return new Response("Lenguaje created successfully", HttpStatus::CREATED, $collection);
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
            return Response('Lenguaje not found', HttpStatus::NOT_FOUND);
        }

        return new Response($lenguaje);
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
            return Response('Lenguaje not found', HttpStatus::NOT_FOUND);
        }

        $lenguaje->update($data);

        return new Response($lenguaje);
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
            return Response('Lenguaje not found', HttpStatus::NOT_FOUND);
        }

        $lenguaje->delete();

        return new Response("", HttpStatus::OK);
    }
}
