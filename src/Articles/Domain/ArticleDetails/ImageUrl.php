<?php

namespace RateArticle\Articles\Domain\ArticleDetails;

use RateArticle\Articles\Domain\Exceptions\ImageUrlTooLong;
use RateArticle\Articles\Domain\Exceptions\ImageUrlTooShort;

class ImageUrl
{
    public const MAX_ADMISSIBLE_LENGTH = 250;
    public const MIN_ADMISSIBLE_LENGTH = 1;

    private string $imageUrl;

    /**
     * ImageUrl constructor.
     * @param string $imageUrl
     * @throws ImageUrlTooLong
     * @throws ImageUrlTooShort
     */
    public function __construct(string $imageUrl)
    {
        $this->isValid($imageUrl);
        $this->imageUrl = $imageUrl;
    }

    /**
     * @param string $imageUrl
     * @throws ImageUrlTooLong
     * @throws ImageUrlTooShort
     */
    private function isValid(string $imageUrl)
    {
        $trimmedImageUrl = trim($imageUrl);
        $imageUrlLength = \mb_strlen($trimmedImageUrl);
        if ($imageUrlLength > self::MAX_ADMISSIBLE_LENGTH) {
            throw ImageUrlTooLong::create($trimmedImageUrl);
        }

        if ($imageUrlLength < self::MIN_ADMISSIBLE_LENGTH) {
            throw ImageUrlTooShort::create($trimmedImageUrl);
        }
    }

    /**
     * @return string
     */
    public function __toString(): string
    {
        return $this->imageUrl;
    }
}