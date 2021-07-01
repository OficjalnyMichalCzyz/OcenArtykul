<?php

namespace RateArticle\Articles\Infrastructure\ArticleDetailsProvider;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\GuzzleException;
use RateArticle\Articles\Domain\ArticleDetails;
use RateArticle\Articles\Domain\ArticleDetails\ArticleUrl;
use RateArticle\Articles\Domain\Exceptions\ArticleUrlInvalid;

class ArticleDetailsBasedOnUrlMetaApi implements ArticleDetailsProvider
{
    /**
     * @var Client
     */
    private Client $client;

    /**
     * @var string
     */
    private string $completeKey;

    /**
     * ArticleDetailsBasedOnUrlMetaApi constructor.
     * @param Client $client
     * @param string $completeKey
     */
    public function __construct(Client $client, string $completeKey)
    {
        $this->client = $client;
        $this->completeKey = $completeKey;
    }

    /**
     * @param ArticleUrl $articleUrl
     * @return ArticleDetails
     * @throws GuzzleException
     * @throws ArticleUrlInvalid
     */
    public function provideArticleDetails(ArticleUrl $articleUrl): ArticleDetails
    {
        $rawArticleDetails = $this->client->request(
            'GET',
            'https://api.urlmeta.org?url=' . $articleUrl,
            [
                'headers' => [
                    'Accept' => 'application/json',
                    'Authorization' => 'Basic ' . $this->completeKey
                ]
            ]);
        $result = json_decode($rawArticleDetails->getBody()->getContents());
        if ($result->result->status == "ERROR") {
            throw ArticleUrlInvalid::create((string)$articleUrl);
        }
        $articleDescription = new ArticleDetails\ArticleDescription(
            mb_strimwidth($result->meta->description,
            0,
            ArticleDetails\ArticleDescription::MAX_ADMISSIBLE_LENGTH - 3,
            '...')
        );
        $imageUrl = new ArticleDetails\ImageUrl($result->meta->image);
        return new ArticleDetails($articleUrl, $imageUrl, $articleDescription);
    }
}