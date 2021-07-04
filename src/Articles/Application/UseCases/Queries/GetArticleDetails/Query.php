<?php

namespace RateArticle\Articles\Application\UseCases\Queries\GetArticleDetails;

class Query
{
    private string $link;

    /**
     * Query constructor.
     * @param string $link
     */
    public function __construct(string $link)
    {
        $this->link = $link;
    }

    /**
     * @return string
     */
    public function getLink(): string
    {
        return $this->link;
    }
}