<?php

namespace RateArticle\Articles\Domain;

use DateTimeImmutable;
use RateArticle\SharedKernel\Domain\OriginIp;

class Article
{
    private int|null $identifier;
    private OriginIp $originIp;
    private DateTimeImmutable $dateOfPosting;
    private ArticleDetails $articleDetails;

    /**
     * Article constructor.
     * @param int|null $identifier
     * @param OriginIp $originIp
     * @param DateTimeImmutable $dateOfPosting
     * @param ArticleDetails $articleDetails
     */
    public function __construct(
        ?int $identifier,
        OriginIp $originIp,
        DateTimeImmutable $dateOfPosting,
        ArticleDetails $articleDetails
    ) {
        $this->identifier = $identifier;
        $this->originIp = $originIp;
        $this->dateOfPosting = $dateOfPosting;
        $this->articleDetails = $articleDetails;
    }

    /**
     * @return int|null
     */
    public function identifier(): ?int
    {
        return $this->identifier;
    }

    /**
     * @return OriginIp
     */
    public function originIp(): OriginIp
    {
        return $this->originIp;
    }

    /**
     * @return DateTimeImmutable
     */
    public function dateOfPosting(): DateTimeImmutable
    {
        return $this->dateOfPosting;
    }

    /**
     * @return ArticleDetails
     */
    public function articleDetails(): ArticleDetails
    {
        return $this->articleDetails;
    }

    /**
     * @param int|null $identifier
     * @return Article
     */
    public function setIdentifier(?int $identifier): Article
    {
        $this->identifier = $identifier;
        return $this;
    }

    /**
     * @param OriginIp $originIp
     * @return Article
     */
    public function setOriginIp(OriginIp $originIp): Article
    {
        $this->originIp = $originIp;
        return $this;
    }

    /**
     * @param DateTimeImmutable $dateOfPosting
     * @return Article
     */
    public function setDateOfPosting(DateTimeImmutable $dateOfPosting): Article
    {
        $this->dateOfPosting = $dateOfPosting;
        return $this;
    }

    /**
     * @param ArticleDetails $articleDetails
     * @return Article
     */
    public function setArticleDetails(ArticleDetails $articleDetails): Article
    {
        $this->articleDetails = $articleDetails;
        return $this;
    }
}