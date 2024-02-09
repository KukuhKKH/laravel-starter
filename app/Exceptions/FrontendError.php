<?php

namespace App\Exceptions;

use Arr;
use Illuminate\Http\JsonResponse;
use Throwable;

class FrontendError extends BaseException
{
    public function __construct(
        string               $message = "",
        int                  $code = 0,
        protected mixed      $data = null,
        protected array|null $meta = null,
        protected int        $status = 200,
        ?Throwable           $previous = null,
    ) {
        parent::__construct($message, $code ?: $this->status, $previous);
    }

    public function render(): JsonResponse
    {
        $meta = [
            'message' => $this->getMessage(),
        ];

        if (config('app.debug')) {
            $meta = array_merge($meta, [
                'exception' => get_class($this),
                'file'      => $this->getFile(),
                'line'      => $this->getLine(),
                'trace'     => collect($this->getTrace())->map(fn ($trace) => Arr::except($trace, ['args']))->all(),
            ]);
        }

        return success(
            $this->data,
            $this->status,
            $this->getCode(),
            $meta,
        );
    }
}
