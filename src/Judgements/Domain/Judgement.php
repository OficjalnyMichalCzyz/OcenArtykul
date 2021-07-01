<?php

namespace RateArticle\Judgements\Domain;

use DateTimeImmutable;
use RateArticle\SharedKernel\Domain\OriginIp;

class Judgement
{
    /**
     * @var int|null
     */
    private int|null $id;

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
     * Judgement constructor.
     * @param int|null $id
     * @param Type $type
     * @param int $judgedArticleId
     * @param Body $body
     * @param OriginIp $originIp
     * @param DateTimeImmutable $dateOfPosting
     */
    public function __construct(?int $id, Type $type, int $judgedArticleId, Body $body, OriginIp $originIp, DateTimeImmutable $dateOfPosting)
    {
        $this->id = $id;
        $this->type = $type;
        $this->judgedArticleId = $judgedArticleId;
        $this->body = $body;
        $this->originIp = $originIp;
        $this->dateOfPosting = $dateOfPosting;
    }

    /**
     * @return int|null
     */
    public function id(): ?int
    {
        return $this->id;
    }

    /**
     * @param int|null $id
     * @return Judgement
     */
    public function setId(?int $id): Judgement
    {
        $this->id = $id;
        return $this;
    }

    /**
     * @return Type
     */
    public function type(): Type
    {
        return $this->type;
    }

    /**
     * @param Type $type
     * @return Judgement
     */
    public function setType(Type $type): Judgement
    {
        $this->type = $type;
        return $this;
    }

    /**
     * @return int
     */
    public function judgedArticleId(): int
    {
        return $this->judgedArticleId;
    }

    /**
     * @param int $judgedArticleId
     * @return Judgement
     */
    public function setJudgedArticleId(int $judgedArticleId): Judgement
    {
        $this->judgedArticleId = $judgedArticleId;
        return $this;
    }

    /**
     * @return Body
     */
    public function body(): Body
    {
        return $this->body;
    }

    /**
     * @param Body $body
     * @return Judgement
     */
    public function setBody(Body $body): Judgement
    {
        $this->body = $body;
        return $this;
    }

    /**
     * @return OriginIp
     */
    public function originIp(): OriginIp
    {
        return $this->originIp;
    }

    /**
     * @param OriginIp $originIp
     * @return Judgement
     */
    public function setOriginIp(OriginIp $originIp): Judgement
    {
        $this->originIp = $originIp;
        return $this;
    }

    /**
     * @return DateTimeImmutable
     */
    public function dateOfPosting(): DateTimeImmutable
    {
        return $this->dateOfPosting;
    }

    /**
     * @param DateTimeImmutable $dateOfPosting
     * @return Judgement
     */
    public function setDateOfPosting(DateTimeImmutable $dateOfPosting): Judgement
    {
        $this->dateOfPosting = $dateOfPosting;
        return $this;
    }
}