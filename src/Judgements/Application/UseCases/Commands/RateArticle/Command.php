<?php

namespace RateArticle\Judgements\Application\UseCases\Commands\RateArticle;

use DateTimeImmutable;
use RateArticle\Judgements\Domain\Body;
use RateArticle\Judgements\Domain\Type;
use RateArticle\SharedKernel\Domain\OriginIp;

class Command
{
    /**
     * @var Type
     */
    private Type $type;

    /**
     * @var int
     */
    private int $judgedArticleId;

    /**
     * @var Body
     */
    private Body $body;

    /**
     * @var OriginIp
     */
    private OriginIp $originIp;

    /**
     * @var DateTimeImmutable
     */
    private DateTimeImmutable $dateOfPosting;

    /**
     * Command constructor.
     * @param Type $type
     * @param int $judgedArticleId
     * @param Body $body
     * @param OriginIp $originIp
     * @param DateTimeImmutable $dateOfPosting
     */
    public function __construct(Type $type, int $judgedArticleId, Body $body, OriginIp $originIp, DateTimeImmutable $dateOfPosting)
    {
        $this->type = $type;
        $this->judgedArticleId = $judgedArticleId;
        $this->body = $body;
        $this->originIp = $originIp;
        $this->dateOfPosting = $dateOfPosting;
    }

    /**
     * @return Type
     */
    public function getType(): Type
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getJudgedArticleId(): int
    {
        return $this->judgedArticleId;
    }

    /**
     * @return Body
     */
    public function getBody(): Body
    {
        return $this->body;
    }

    /**
     * @return OriginIp
     */
    public function getOriginIp(): OriginIp
    {
        return $this->originIp;
    }

    /**
     * @return DateTimeImmutable
     */
    public function getDateOfPosting(): DateTimeImmutable
    {
        return $this->dateOfPosting;
    }
}