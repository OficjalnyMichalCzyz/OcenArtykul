<?php

namespace RateArticle\Articles\Controllers;

use RateArticle\Articles\Application\UseCases\Queries\GetAllArticles\Handler;
use RateArticle\SharedKernel\Controllers\HttpController;
use Symfony\Component\HttpFoundation\Response;

final class GetAllArticles extends HttpController
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

    public function run(): Response
    {
        $arrayOfArticles = $this->handler->handle();
        $finalResponse = [];
        foreach ($arrayOfArticles as $article) {
            $finalResponse[] = [
                "id" => $article->identifier(),
                "dateOfPosting" => $article->dateOfPosting(),
                "articleDescription" => (string)$article->articleDetails()->articleDescription(),
                "articleUrl" => (string)$article->articleDetails()->articleUrl(),
                "imageUrl" => (string)$article->articleDetails()->imageUrl()
            ];
        }
        return $this->createResponse(200, json_encode($finalResponse));
    }
}