<?php


namespace RateArticle\Judgements\Application\UseCases\Commands\RateArticle;

use RateArticle\Judgements\Domain\Judgement;
use RateArticle\Judgements\Infrastructure\RepositoryAdapter\RepositoryBasedOnMysql as JudgementsRepository;

class Handler
{
    /**
     * @var JudgementsRepository
     */
    private JudgementsRepository $judgementsRepository;

    /**
     * Handler constructor.
     * @param JudgementsRepository $judgementsRepository
     */
    public function __construct(JudgementsRepository $judgementsRepository)
    {
        $this->judgementsRepository = $judgementsRepository;
    }

    /**
     * @param Command $command
     * @return Judgement
     */
    public function handle(Command $command): Judgement
    {
        $judgement = new Judgement(null, $command->getType(), $command->getJudgedArticleId(), $command->getBody(), $command->getOriginIp(), $command->getDateOfPosting());
        $this->judgementsRepository->addNew($judgement);
        return $judgement;
    }
}