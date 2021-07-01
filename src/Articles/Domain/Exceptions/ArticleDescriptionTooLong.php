<?php

namespace RateArticle\Articles\Domain\Exceptions;

use RateArticle\SharedKernel\Domain\Exceptions\ValidationError;

class ArticleDescriptionTooLong extends ValidationError
{
    public static function create(string $tooLongArticleDescription): self
    {
        return new self(\sprintf("'%s' is too long articleDescription!", $tooLongArticleDescription));
    }
}