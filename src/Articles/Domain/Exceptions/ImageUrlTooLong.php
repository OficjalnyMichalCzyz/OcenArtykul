<?php

namespace RateArticle\Articles\Domain\Exceptions;

use RateArticle\SharedKernel\Domain\Exceptions\ValidationError;

class ImageUrlTooLong extends ValidationError
{
    public static function create(string $tooLongImageUrl): self
    {
        return new self(\sprintf("'%s' is too long imageUrl!", $tooLongImageUrl));
    }
}