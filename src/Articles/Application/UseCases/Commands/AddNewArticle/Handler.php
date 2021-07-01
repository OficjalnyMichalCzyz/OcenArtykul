<?php


namespace RateArticle\Articles\Application\UseCases\Commands\AddNewArticle;

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
     * @param Command $command
     * @return Article
     */
    public function handle(Command $command): Article
    {
        $article = new Article(null, $command->originIp(), $command->dateOfPosting(), $command->articleDetails());
        $this->articleRepository->addNew($article);
        return $article;
    }
}