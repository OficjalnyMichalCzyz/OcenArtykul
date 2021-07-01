<?php

namespace RateArticle\Judgements\Domain\Exceptions;

use RateArticle\SharedKernel\Domain\Exceptions\ValidationError;

class BodyTooLong extends ValidationError
{
    public static function create(string $tooLongBody): self
    {
        return new self(\sprintf("'%s' is too long body!", $tooLongBody));
    }
}