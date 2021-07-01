<?php

namespace RateArticle\Judgements\Controllers;

use RateArticle\Judgements\Application\UseCases\Queries\GetJudgements\Handler;
use RateArticle\Judgements\Application\UseCases\Queries\GetJudgements\Query;
use RateArticle\SharedKernel\Controllers\HttpController;
use Symfony\Component\HttpFoundation\Response;

final class GetJudgements extends HttpController
{
    private Handler $handler;

    /**
     * @param Handler $handler
     */
    public function __construct(Handler $handler)
    {
        $this->handler = $handler;
    }

    public function run(int $articleId): Response
    {
        $query = new Query($articleId);
        $arrayOfJudgements = $this->handler->handle($query);
        $finalResponse = [];
        foreach ($arrayOfJudgements as $judgement) {
            $finalResponse[] = [
                "id" => $judgement->id(),
                "dateOfPosting" => $judgement->dateOfPosting(),
                "value" => (string)$judgement->type()->getValue(),
                "body" => (string)$judgement->body()
            ];
        }

        return $this->createResponse(200, json_encode($finalResponse));
    }
}