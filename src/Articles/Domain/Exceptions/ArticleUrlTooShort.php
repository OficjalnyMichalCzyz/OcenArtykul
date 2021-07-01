<?php

namespace RateArticle\Articles\Domain\Exceptions;

use RateArticle\SharedKernel\Domain\Exceptions\ValidationError;

class ArticleUrlTooShort extends ValidationError
{
    public static function create(string $tooShortArticleUrl): self
    {
        return new self(\sprintf("'%s' is too short articleUrl!", $tooShortArticleUrl));
    }
}