<?php


namespace RateArticle\Articles\Infrastructure\RepositoryAdapter;

use Doctrine\DBAL\ParameterType;
use Doctrine\ORM\EntityManagerInterface;
use RateArticle\Articles\Domain\Article;
use RateArticle\Articles\Domain\ArticleDetails;
use RateArticle\Articles\Domain\Repository;
use RateArticle\SharedKernel\Domain\OriginIp;

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
     * @param int $identifier
     * @return Article
     */
    public function getByIdentifier(int $identifier): Article
    {
        $connection = $this->entityManager->getConnection();
        $sql = '
            SELECT articleDescription, articleUrl, imageUrl, originIp, dateOfPosting FROM Articles 
            WHERE id = :id
            ';
        $query = $connection->prepare($sql);
        $query->bindValue("id", $identifier, ParameterType::INTEGER);
        $result = $query->executeQuery()->fetchAssociative();
        return new Article(
            $identifier,
            new OriginIp($result["originIp"]),
            new \DateTimeImmutable(($result["dateOfPosting"])),
            new ArticleDetails(
                new ArticleDetails\ArticleUrl($result["articleUrl"]),
                new ArticleDetails\ImageUrl($result["imageUrl"]),
                new ArticleDetails\ArticleDescription($result["articleDescription"])
            )
        );
    }

    /**
     * @param Article $article
     * @throws \Doctrine\DBAL\Driver\Exception
     * @throws \Doctrine\DBAL\Exception
     */
    protected function add(Article $article): void
    {
        $connection = $this->entityManager->getConnection();
        $sql = '
            INSERT INTO Articles (articleDescription, articleUrl, imageUrl, originIp, dateOfPosting)
                VALUES (:articleDescription, :articleUrl, :imageUrl, :originIp, :dateOfPosting);
            SELECT last_insert_id() AS id;
            ';
        $query = $connection->prepare($sql);
        $query->bindValue("articleDescription", $article->articleDetails()->articleDescription(), ParameterType::STRING);
        $query->bindValue("articleUrl", $article->articleDetails()->articleUrl(), ParameterType::STRING);
        $query->bindValue("imageUrl", $article->articleDetails()->imageUrl(), ParameterType::STRING);
        $query->bindValue("originIp", $article->originIp()->originIp(), ParameterType::INTEGER);
        $query->bindValue("dateOfPosting", $article->dateOfPosting()->format(("Y-m-d H:i:s")), ParameterType::STRING);
        $query->executeQuery();

        $sql = 'SELECT last_insert_id() AS id;';
        $query = $connection->prepare($sql);
        $result = $query->executeQuery();
        $article->setIdentifier($result->fetchOne());
    }

    /**
     * @return array
     */
    public function getAll(): array
    {
        $connection = $this->entityManager->getConnection();
        $sql = '
            SELECT id, articleDescription, articleUrl, imageUrl, originIp, dateOfPosting FROM Articles
            ';
        $query = $connection->prepare($sql);
        $results = $query->executeQuery()->fetchAllAssociative();
        $arrayOfArticles = [];
        foreach ($results as $result) {
            $arrayOfArticles[] = new Article(
                $result["id"],
                new OriginIp($result["originIp"]),
                new \DateTimeImmutable(($result["dateOfPosting"])),
                new ArticleDetails(
                    new ArticleDetails\ArticleUrl($result["articleUrl"]),
                    new ArticleDetails\ImageUrl($result["imageUrl"]),
                    new ArticleDetails\ArticleDescription($result["articleDescription"])
                )
            );
        }
        return $arrayOfArticles;
    }
}