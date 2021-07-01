<?php

namespace RateArticle\Articles\Domain\ArticleDetails;

use RateArticle\Articles\Domain\Exceptions\ArticleDescriptionTooLong;
use RateArticle\Articles\Domain\Exceptions\ArticleDescriptionTooShort;

class ArticleDescription
{
    public const MAX_ADMISSIBLE_LENGTH = 500;
    public const MIN_ADMISSIBLE_LENGTH = 0;

    private string $articleDescription;

    /**
     * ArticleDescription constructor.
     * @param string $articleDescription
     * @throws ArticleDescriptionTooLong
     * @throws ArticleDescriptionTooShort
     */
    public function __construct(string $articleDescription)
    {
        $this->isValid($articleDescription);
        $this->articleDescription = $articleDescription;
    }

    /**
     * @param string $articleDescription
     * @throws ArticleDescriptionTooLong
     * @throws ArticleDescriptionTooShort
     */
    private function isValid(string $articleDescription)
    {
        $trimmedArticleDescription= trim($articleDescription);
        $articleDescriptionLength = \mb_strlen($trimmedArticleDescription);
        if ($articleDescriptionLength > self::MAX_ADMISSIBLE_LENGTH) {
            throw ArticleDescriptionTooLong::create($articleDescription);
        }

        if ($articleDescriptionLength < self::MIN_ADMISSIBLE_LENGTH) {
            throw ArticleDescriptionTooShort::create($articleDescription);
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->articleDescription;
    }
}