<?php

namespace App\Http\Responses;

use App\Http\Responses\HttpStatus;

/**
 * Just a helper for the Response class, to improve the readability of
 * the code.
 *
 * Class ErrorResponse
 * @package App\Http
 */
class ErrorResponse extends Response
{
    public function __construct(string $message, int $statusCode = HttpStatus::INTERNAL_SERVER_ERROR, $data = null)
    {
        parent::__construct($message, $statusCode, $data);
    }
}
