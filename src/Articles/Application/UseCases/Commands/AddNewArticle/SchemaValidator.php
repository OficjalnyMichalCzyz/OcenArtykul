<?php

namespace RateArticle\Articles\Application\UseCases\Commands\AddNewArticle;

use RateArticle\SharedKernel\Application\Exceptions\SchemaError;

class SchemaValidator
{
    /**
     * @param array $data
     * @throws SchemaError
     */
    public function validate(array $data): void
    {
        if (!isset($data["articleUrl"])) {
            throw SchemaError::createWithError("MISSING.ARTICLE_URL");
        }

        if (!is_string($data["articleUrl"])) {
            throw SchemaError::createWithError("INVALID_TYPE.ARTICLE_URL");
        }
    }
}