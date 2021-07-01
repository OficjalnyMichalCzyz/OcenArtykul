<?php

namespace RateArticle\Articles\Domain\Exceptions;

use RateArticle\SharedKernel\Domain\Exceptions\ValidationError;

class ArticleUrlTooLong extends ValidationError
{
    public static function create(string $tooLongArticleUrl): self
    {
        return new self(\sprintf("'%s' is too long articleUrl!", $tooLongArticleUrl));
    }
}