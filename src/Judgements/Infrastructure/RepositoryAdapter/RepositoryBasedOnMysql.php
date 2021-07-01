<?php

namespace RateArticle\Judgements\Infrastructure\RepositoryAdapter;

use Doctrine\DBAL\ParameterType;
use Doctrine\ORM\EntityManagerInterface;
use RateArticle\Judgements\Domain\Body;
use RateArticle\Judgements\Domain\Exceptions\AlreadyJudged;
use RateArticle\Judgements\Domain\Judgement;
use RateArticle\Judgements\Domain\Repository;
use RateArticle\Judgements\Domain\Type;
use RateArticle\SharedKernel\Domain\OriginIp;
use function Composer\Autoload\includeFile;

class RepositoryBasedOnMysql extends Repository
{
    private EntityManagerInterface $entityManager;

    /**
     * RepositoryBasedOnMysql constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    /**
     * @inheritDoc
     */
    public function getAllByArticleId(int $identifier): array
    {
        $connection = $this->entityManager->getConnection();
        $sql = '
            SELECT id, body, dateOfPosting, judgementType, originIp FROM Judgements 
            WHERE judgedArticleId = :judgedArticleId
            ';
        $query = $connection->prepare($sql);
        $query->bindValue("judgedArticleId", $identifier, ParameterType::INTEGER);
        $results = $query->executeQuery()->fetchAllAssociative();
        $arrayOfJudgements = [];
        foreach ($results as $result) {
            $arrayOfJudgements[] = new Judgement(
                $result["id"],
                new Type($result["judgementType"]),
                $identifier,
                new Body($result["body"]),
                new OriginIp($result["originIp"]),
                new \DateTimeImmutable($result["dateOfPosting"])
            );
        }
        return $arrayOfJudgements;
    }

    /**
     * @param Judgement $judgement
     * @throws AlreadyJudged
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws \Doctrine\DBAL\Exception
     */
    protected function add(Judgement $judgement): void
    {
        $connection = $this->entityManager->getConnection();
        $sql = 'SELECT originIp FROM Judgements 
            WHERE judgedArticleId = :judgedArticleId';
        $query = $connection->prepare($sql);
        $query->bindValue("judgedArticleId", $judgement->judgedArticleId(), ParameterType::INTEGER);
        if($judgement->originIp()->originIp() == $query->executeQuery()->fetchOne()) {
            throw AlreadyJudged::create($judgement->originIp()->originIp());
        }

        $sql = '
            INSERT INTO Judgements (body, dateOfPosting, judgementType, originIp, judgedArticleId)
                VALUES (:body, :dateOfPosting, :judgementType, :originIp, :judgedArticleId);
            SELECT last_insert_id() AS id;
            ';
        $query = $connection->prepare($sql);
        $query->bindValue("body", (string)$judgement->body(), ParameterType::STRING);
        $query->bindValue("dateOfPosting", $judgement->dateOfPosting()->format(("Y-m-d H:i:s")), ParameterType::STRING);
        $query->bindValue("judgementType", $judgement->type()->getValue(), ParameterType::INTEGER);
        $query->bindValue("originIp", $judgement->originIp()->originIp(), ParameterType::INTEGER);
        $query->bindValue("judgedArticleId", $judgement->judgedArticleId(), ParameterType::INTEGER);
        $query->executeQuery();

        $sql = 'SELECT last_insert_id() AS id;';
        $query = $connection->prepare($sql);
        $result = $query->executeQuery();
        $judgement->setId($result->fetchOne());
    }
}