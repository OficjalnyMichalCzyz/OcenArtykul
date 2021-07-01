<?php

namespace RateArticle\Judgements\Application\UseCases\Commands\RateArticle;

use RateArticle\SharedKernel\Application\Exceptions\SchemaError;

class SchemaValidator
{
    /**
     * @param array $data
     * @throws SchemaError
     */
    public function validate(array $data): void
    {
        if (!isset($data["type"])) {
            throw SchemaError::createWithError("MISSING.JUDGEMENT_TYPE");
        }

        if (!is_int($data["type"])) {
            throw SchemaError::createWithError("INVALID_TYPE.JUDGEMENT_TYPE");
        }

        if (!isset($data["judgedArticleId"])) {
            throw SchemaError::createWithError("MISSING.ARTICLE_IDL");
        }

        if (!is_int($data["judgedArticleId"])) {
            throw SchemaError::createWithError("INVALID_TYPE.ARTICLE_ID");
        }

        if (!isset($data["body"])) {
            throw SchemaError::createWithError("MISSING.JUDGEMENT_BODY");
        }

        if (!is_string($data["body"])) {
            throw SchemaError::createWithError("INVALID_TYPE.JUDGEMENT_BODY");
        }
    }
}