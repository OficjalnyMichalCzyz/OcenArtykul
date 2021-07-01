<?php

namespace RateArticle\SharedKernel\Application\Exceptions;

class SchemaError extends \Exception
{
    public static function createWithError(string $error): self
    {
        return new SchemaError($error);
    }
}