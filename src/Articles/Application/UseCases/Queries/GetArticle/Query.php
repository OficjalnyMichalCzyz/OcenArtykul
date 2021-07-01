<?php

namespace RateArticle\Articles\Application\UseCases\Queries\GetArticle;

class Query
{
    private int $articleId;

    /**
     * Query constructor.
     * @param int $articleId
     */
    public function __construct(int $articleId)
    {
        $this->articleId = $articleId;
    }

    /**
     * @return int
     */
    public function getArticleId(): int
    {
        return $this->articleId;
    }
}