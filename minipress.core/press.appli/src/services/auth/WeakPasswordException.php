<?php

namespace press\app\services\auth;

use Exception;
use Throwable;
class WeakPasswordException extends Exception
{
    public function __construct(string $message = "Mot de passe faible", int $code = 0, Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}