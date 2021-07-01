<?php


namespace RateArticle\Articles\Application\UseCases\Queries\GetAllArticles;

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
     * @return Article[]
     */
    public function handle(): array
    {
        return $this->articleRepository->getAll();
    }
}