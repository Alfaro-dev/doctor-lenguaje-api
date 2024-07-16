<?php

namespace App\Http\Responses;

use Illuminate\Http\JsonResponse;

class Response
{
    private mixed $data;
    private string $reason;
    private int $status;

    public function __construct(string $reason = '', int $status = 200, mixed $data = null)
    {
        $this->status = $status;
        $this->data = $data;
        $this->reason = $reason;
    }

    public function getJsonResponse(): JsonResponse
    {
        return response()->json([
            'success' => $this->status >= 200 && $this->status < 300,
            'message' => $this->reason ?: ($this->status >= 200 && $this->status < 300 ? 'Success' : 'Internal Server Error'),
            'data' => $this->data
        ], $this->status);
    }
}