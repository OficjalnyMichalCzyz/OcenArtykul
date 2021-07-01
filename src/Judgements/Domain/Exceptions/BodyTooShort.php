<?php

namespace RateArticle\Judgements\Domain\Exceptions;

use RateArticle\SharedKernel\Domain\Exceptions\ValidationError;

class BodyTooShort extends ValidationError
{
    public static function create(string $tooShortBody): self
    {
        return new self(\sprintf("'%s' is too short body!", $tooShortBody));
    }
}