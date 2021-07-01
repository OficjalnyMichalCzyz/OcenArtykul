<?php

namespace RateArticle\Articles\Domain\Exceptions;

use RateArticle\SharedKernel\Domain\Exceptions\ValidationError;

class ArticleUrlInvalid extends ValidationError
{
    public static function create(string $invalidArticleUrl): self
    {
        return new self(\sprintf("'%s' is invalid articleUrl!", $invalidArticleUrl));
    }
}