<?php

namespace App\Exceptions;

use Throwable;

class ClientError extends BaseException
{
    public function __construct(
        string $message = "",
        int $code = 0,
        protected mixed $data = null,
        protected array|null $meta = null,
        protected int $status = 490,
        ?Throwable $previous = null,
    )
    {
        parent::__construct($message, $code ?: $this->status, $previous);
    }
}
