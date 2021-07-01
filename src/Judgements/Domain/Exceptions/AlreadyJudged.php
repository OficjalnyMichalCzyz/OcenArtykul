<?php

namespace RateArticle\Judgements\Domain\Exceptions;

use RateArticle\SharedKernel\Domain\Exceptions\ValidationError;

class AlreadyJudged extends ValidationError
{
    public static function create(int $originIpWhichAlreadyJudged): self
    {
        return new self(\sprintf("'%s' has already judged!", (string)$originIpWhichAlreadyJudged));
    }
}