<?php

namespace RateArticle\Articles\Application\UseCases\Commands\AddNewArticle;

use DateTimeImmutable;
use RateArticle\Articles\Domain\ArticleDetails;
use RateArticle\SharedKernel\Domain\OriginIp;

class Command
{
    private ArticleDetails $articleDetails;
    private DateTimeImmutable $dateOfPosting;
    private OriginIp $originIp;

    /**
     * Command constructor.
     * @param ArticleDetails $articleDetails
     * @param DateTimeImmutable $dateOfPosting
     * @param OriginIp $originIp
     */
    public function __construct(ArticleDetails $articleDetails, DateTimeImmutable $dateOfPosting, OriginIp $originIp)
    {
        $this->articleDetails = $articleDetails;
        $this->dateOfPosting = $dateOfPosting;
        $this->originIp = $originIp;
    }

    /**
     * @return DateTimeImmutable
     */
    public function dateOfPosting(): DateTimeImmutable
    {
        return $this->dateOfPosting;
    }

    /**
     * @return OriginIp
     */
    public function originIp(): OriginIp
    {
        return $this->originIp;
    }

    /**
     * @return ArticleDetails
     */
    public function articleDetails(): ArticleDetails
    {
        return $this->articleDetails;
    }
}