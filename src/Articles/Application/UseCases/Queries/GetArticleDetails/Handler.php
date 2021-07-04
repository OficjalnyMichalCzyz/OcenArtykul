<?php


namespace RateArticle\Articles\Application\UseCases\Queries\GetArticleDetails;

use RateArticle\Articles\Domain\ArticleDetails;
use RateArticle\Articles\Infrastructure\ArticleDetailsProvider\ArticleDetailsProvider;

class Handler
{
    private ArticleDetailsProvider $articleDetailsProvider;

    /**
     * Handler constructor.
     * @param ArticleDetailsProvider $articleDetailsProvider
     */
    public function __construct(ArticleDetailsProvider $articleDetailsProvider)
    {
        $this->articleDetailsProvider = $articleDetailsProvider;
    }

    /**
     * @param Query $query
     * @return ArticleDetails
     * @throws \RateArticle\Articles\Domain\Exceptions\ArticleUrlTooLong
     * @throws \RateArticle\Articles\Domain\Exceptions\ArticleUrlTooShort
     */
    public function handle(Query $query): ArticleDetails
    {
        return $this->articleDetailsProvider->provideArticleDetails(new ArticleDetails\ArticleUrl($query->getLink()));
    }
}