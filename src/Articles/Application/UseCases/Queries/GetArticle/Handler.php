<?php


namespace RateArticle\Articles\Application\UseCases\Queries\GetArticle;

use RateArticle\Articles\Domain\Article;
use RateArticle\Articles\Infrastructure\RepositoryAdapter\RepositoryBasedOnMysql as ArticleRepository;

class Handler
{
    /**
     * @var ArticleRepository
     */
    private ArticleRepository $articleRepository;

    /**
     * Handler constructor.
     * @param ArticleRepository $articleRepository
     */
    public function __construct(ArticleRepository $articleRepository)
    {
        $this->articleRepository = $articleRepository;
    }

    /**
     * @param Query $query
     * @return Article
     */
    public function handle(Query $query): Article
    {
        return $this->articleRepository->getByIdentifier($query->getArticleId());
    }
}