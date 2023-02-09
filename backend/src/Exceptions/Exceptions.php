<?php

namespace App\src\Exceptions;
use Exception;
class ResourceNotFoundException extends Exception {
    public function __construct(string $message = "", int $code = 0, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}