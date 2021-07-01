<?php

namespace RateArticle\Articles\Domain\ArticleDetails;

use RateArticle\Articles\Domain\Exceptions\ArticleUrlTooLong;
use RateArticle\Articles\Domain\Exceptions\ArticleUrlTooShort;

class ArticleUrl
{
    public const MAX_ADMISSIBLE_LENGTH = 250;
    public const MIN_ADMISSIBLE_LENGTH = 1;

    private string $articleUrl;

    /**
     * ArticleUrl constructor.
     * @param string $articleUrl
     * @throws ArticleUrlTooLong
     * @throws ArticleUrlTooShort
     */
    public function __construct(string $articleUrl)
    {
        $this->isValid($articleUrl);
        $this->articleUrl = $articleUrl;
    }

    /**
     * @param string $articleUrl
     * @throws ArticleUrlTooLong
     * @throws ArticleUrlTooShort
     */
    private function isValid(string $articleUrl)
    {
        $trimmedArticleUrl = trim($articleUrl);
        $articleUrlLength = \mb_strlen($trimmedArticleUrl);
        if ($articleUrlLength > self::MAX_ADMISSIBLE_LENGTH) {
            throw ArticleUrlTooLong::create($articleUrl);
        }

        if ($articleUrlLength < self::MIN_ADMISSIBLE_LENGTH) {
            throw ArticleUrlTooShort::create($articleUrl);
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->articleUrl;
    }
}