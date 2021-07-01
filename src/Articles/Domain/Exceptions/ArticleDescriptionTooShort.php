<?php

namespace RateArticle\Articles\Domain\Exceptions;

use RateArticle\SharedKernel\Domain\Exceptions\ValidationError;

class ArticleDescriptionTooShort extends ValidationError
{
    public static function create(string $tooShortArticleDescription): self
    {
        return new self(\sprintf("'%s' is too short articleDescription!", $tooShortArticleDescription));
    }
}