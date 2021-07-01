<?php

namespace RateArticle\Judgements\Domain;

use RateArticle\Judgements\Domain\Exceptions\BodyTooLong;
use RateArticle\Judgements\Domain\Exceptions\BodyTooShort;

class Body
{
    public const MAX_ADMISSIBLE_LENGTH = 2500;
    public const MIN_ADMISSIBLE_LENGTH = 3;

    private string $body;

    /**
     * Body constructor.
     * @param string $body
     * @throws BodyTooLong
     * @throws BodyTooShort
     */
    public function __construct(string $body)
    {
        $this->isValid($body);
        $this->body = $body;
    }

    /**
     * @param string $body
     * @throws BodyTooLong
     * @throws BodyTooShort
     */
    private function isValid(string $body)
    {
        $trimmedBody= trim($body);
        $bodyLength = \mb_strlen($trimmedBody);
        if ($bodyLength > self::MAX_ADMISSIBLE_LENGTH) {
            throw BodyTooLong::create($body);
        }

        if ($bodyLength < self::MIN_ADMISSIBLE_LENGTH) {
            throw BodyTooShort::create($body);
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->body;
    }
}