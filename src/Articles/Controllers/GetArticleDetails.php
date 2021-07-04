<?php

namespace RateArticle\Articles\Controllers;

use Symfony\Component\HttpFoundation\Request;
use RateArticle\Articles\Application\UseCases\Queries\GetArticleDetails\Handler;
use RateArticle\Articles\Application\UseCases\Queries\GetArticleDetails\Query;
use RateArticle\SharedKernel\Controllers\HttpController;
use Symfony\Component\HttpFoundation\Response;

final class GetArticleDetails extends HttpController
{
    private Handler $handler;

    /**
     * @param Handler $handler
     */
    public function __construct(Handler $handler)
    {
        $this->handler = $handler;
    }

    public function run(Request $request): Response
    {
        try {
            $requestData = $this->extractJsonDataFromRequest($request);
        } catch (\JsonException $e) {
            return $this->createResponse(400, "Invalid json");
        }
        if (!isset($requestData["link"])) {
            return $this->createResponse(400, "Link no passed");
        }
        if (!is_string($requestData["link"])) {
            return $this->createResponse(400, "Link not string");
        }

        $query = new Query($requestData["link"]);
        $articleDetails = $this->handler->handle($query);

        return $this->createResponse(
            200,
            json_encode(
                [
                    "articleDescription" => (string)$articleDetails->articleDescription(),
                    "articleUrl" => (string)$articleDetails->articleUrl(),
                    "imageUrl" => (string)$articleDetails->imageUrl()
                ]
            )
        );
    }
}