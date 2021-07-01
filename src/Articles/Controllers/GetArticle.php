<?php

namespace RateArticle\Articles\Controllers;

use RateArticle\Articles\Application\UseCases\Queries\GetArticle\Handler;
use RateArticle\Articles\Application\UseCases\Queries\GetArticle\Query;
use RateArticle\SharedKernel\Controllers\HttpController;
use Symfony\Component\HttpFoundation\Response;

final class GetArticle extends HttpController
{
    private Handler $handler;

    /**
     * CreateNewArticle constructor.
     * @param Handler $handler
     */
    public function __construct(Handler $handler)
    {
        $this->handler = $handler;
    }

    public function run(int $articleId): Response
    {
        $query = new Query($articleId);
        $article = $this->handler->handle($query);

        return $this->createResponse(
            200,
            json_encode(
                [
                    "id" => $article->identifier(),
                    "dateOfPosting" => $article->dateOfPosting(),
                    "articleDescription" => (string)$article->articleDetails()->articleDescription(),
                    "articleUrl" => (string)$article->articleDetails()->articleUrl(),
                    "imageUrl" => (string)$article->articleDetails()->imageUrl()
                ]
            )
        );
    }
}