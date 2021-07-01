<?php

namespace RateArticle\Judgements\Domain;

use RateArticle\Judgements\Domain\Exceptions\TypeValueInvalid;

class Type
{
    public const POSSIBLE_TYPES = [
        "LEGIT_ARTICLE" => 1,
        "FAKE_ARTICLE" => 0
    ];

    private int $value;

    /**
     * Type constructor.
     * @param int $value
     * @throws TypeValueInvalid
     */
    public function __construct(int $value)
    {
        $this->checkIfGivenPossibleTypeValue($value);
        $this->value = $value;
    }

    /**
     * @param int $value
     * @throws TypeValueInvalid
     */
    private function checkIfGivenPossibleTypeValue(int $value)
    {
        if (!in_array($value, self::POSSIBLE_TYPES)) {
            throw TypeValueInvalid::create($value);
        }
    }

    /**
     * @return int
     */
    public function getValue(): int
    {
        return $this->value;
    }

    public function getName(): string
    {
        return array_search($this->value, self::POSSIBLE_TYPES);
    }
}