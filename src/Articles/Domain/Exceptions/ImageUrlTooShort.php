<?php

namespace RateArticle\Articles\Domain\Exceptions;

use RateArticle\SharedKernel\Domain\Exceptions\ValidationError;

class ImageUrlTooShort extends ValidationError
{
    public static function create(string $tooShortImageUrl): self
    {
        return new self(\sprintf("'%s' is too short imageUrl!", $tooShortImageUrl));
    }
}