<?php

namespace App\Http\Responses;

use App\Http\Responses\HttpStatus;
use Illuminate\Http\JsonResponse;

class Response
{
    private mixed $data;
    private bool $isError;
    private bool $isSuccess;
    private string $reason;
    private int $status;

    public function __construct(string $reason = '', int $status = HttpStatus::ACCEPTED, mixed $data = null)
    {
        $this->status = $status;

        $this->data = $data;
        $this->reason = $reason;

        $this->isError = $this->getIsError();
        $this->isSuccess = $this->getIsSuccess();
    }

    public function isClientError(): bool
    {
        $status = $this->getStatus();
        $statusIsHigherThan400 = $status >= 400;
        $statusIsLessThan500 = $status < 500;

        return $statusIsHigherThan400 && $statusIsLessThan500;
    }

    public function isServerError(): bool
    {
        $status = $this->getStatus();
        $statusIsHigherThan500 = $status >= 500;
        $statusIsLessThan600 = $status < 600;

        return $statusIsHigherThan500 && $statusIsLessThan600;
    }

    public function isError(): bool
    {
        return $this->isError;
    }

    public function isSuccess(): bool
    {
        return $this->isSuccess;
    }

    /**
     * If the data is just a boolean value, we will return that. Otherwise,
     * return false.
     *
     * @return bool
     */
    public function getBooleanFromResponseBody(): bool
    {
        $responseBody = $this->getData();

        if (is_bool($responseBody)) {
            return $responseBody;
        }

        return false;
    }

    private function getIsError(): bool
    {
        $statusIsLessThan200 = $this->status < 200;
        $statusIsHigherThan300 = $this->status >= 300;

        $isError = $statusIsLessThan200 || $statusIsHigherThan300;

        return $isError;
    }

    private function getIsSuccess(): bool
    {
        $statusIsAtLeast200 = $this->status >= 200;
        $statusIsLessThan300 = $this->status < 300;

        return $statusIsAtLeast200 && $statusIsLessThan300;
    }

    public function getReason(): string
    {
        if (!empty($this->reason)) {
            return $this->reason;
        }

        return $this->status;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getEndUserMessage(): string
    {
        if ($this->isServerError()) {
            return 'There were a problem trying to perform your action. Please try again later!';
        }

        return $this->reason;
    }

    public function getData(): mixed
    {
        return $this->data;
    }

    public function getJsonResponse(): JsonResponse
    {
        return response()->json($this->getData(), $this->getStatus());
    }
}
