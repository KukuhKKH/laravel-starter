<?php

namespace App\Exceptions;

use Arr;
use Exception;
use GraphQL\Error\ClientAware;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Response;
use Throwable;

abstract class BaseException extends Exception implements ClientAware
{
    public function __construct(
        string $message = "",
        int $code = 0,
        protected mixed $data = null,
        protected array|null $meta = null,
        protected int $status = 500,
        ?Throwable $previous = null,
    )
    {
        parent::__construct($message, $code, $previous);
    }

    public function render(): JsonResponse
    {
        $meta = null;
        if (config('app.debug')) {
            $meta = [
                'exception' => get_class($this),
                'file'      => $this->getFile(),
                'line'      => $this->getLine(),
                'trace'     => collect($this->getTrace())->map(fn($trace) => Arr::except($trace, ['args']))->all(),
            ];
        }

        return Response::error(
            $this->getMessage(),
            $this->data,
            $this->status,
            $this->getCode(),
            $meta,
        );
    }

    public function isClientSafe(): bool
    {
        return true;
    }
}
