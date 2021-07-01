<?php


namespace RateArticle\Judgements\Application\UseCases\Queries\GetJudgements;

use RateArticle\Judgements\Domain\Judgement;
use RateArticle\Judgements\Infrastructure\RepositoryAdapter\RepositoryBasedOnMysql as JudgementRepository;

class Handler
{
    /**
     * @var JudgementRepository
     */
    private JudgementRepository $judgementRepository;

    /**
     * Handler constructor.
     * @param JudgementRepository $judgementRepository
     */
    public function __construct(JudgementRepository $judgementRepository)
    {
        $this->judgementRepository = $judgementRepository;
    }

    /**
     * @param Query $query
     * @return Judgement[]
     */
    public function handle(Query $query): array
    {
        return $this->judgementRepository->getAllByArticleId($query->getArticleId());
    }
}