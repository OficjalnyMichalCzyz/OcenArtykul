<?php

namespace RateArticle\Judgements\Domain\Exceptions;

use RateArticle\SharedKernel\Domain\Exceptions\ValidationError;

class TypeValueInvalid extends ValidationError
{
    public static function create(int $invalidTypeValue): self
    {
        return new self(\sprintf("'%s' is invalid judgement type!", (string)$invalidTypeValue));
    }
}