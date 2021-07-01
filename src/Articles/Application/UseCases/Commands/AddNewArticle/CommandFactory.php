<?php

namespace RateArticle\Articles\Application\UseCases\Commands\AddNewArticle;

use RateArticle\Articles\Domain\ArticleDetails\ArticleUrl;
use RateArticle\Articles\Domain\Exceptions\ArticleUrlTooLong;
use RateArticle\Articles\Domain\Exceptions\ArticleUrlTooShort;
use RateArticle\Articles\Infrastructure\ArticleDetailsProvider\ArticleDetailsProvider;
use RateArticle\Articles\Infrastructure\ClientIpAddressProvider\ClientIpAddressProvider;
use RateArticle\SharedKernel\Application\Exceptions\SchemaError;
use RateArticle\SharedKernel\Domain\Exceptions\OriginIpInvalid;
use RateArticle\SharedKernel\Domain\OriginIp;

class CommandFactory
{
    /**
     * @var ArticleDetailsProvider
     */
    private ArticleDetailsProvider $articleDetailsProvider;

    /**
     * @var SchemaValidator
     */
    private SchemaValidator $schemaValidator;

    /**
     * @var ClientIpAddressProvider
     */
    private ClientIpAddressProvider $clientIpAddressProvider;

    /**
     * CommandFactory constructor.
     * @param ArticleDetailsProvider $articleDetailsProvider
     * @param SchemaValidator $schemaValidator
     * @param ClientIpAddressProvider $clientIpAddressProvider
     */
    public function __construct(
        ArticleDetailsProvider $articleDetailsProvider,
        SchemaValidator $schemaValidator,
        ClientIpAddressProvider $clientIpAddressProvider
    )   {
        $this->articleDetailsProvider = $articleDetailsProvider;
        $this->schemaValidator = $schemaValidator;
        $this->clientIpAddressProvider = $clientIpAddressProvider;
    }

    /**
     * @param array $data
     * @return Command
     * @throws ArticleUrlTooLong
     * @throws ArticleUrlTooShort
     * @throws OriginIpInvalid
     * @throws SchemaError
     */
    public function create(array $data): Command
    {
        $this->schemaValidator->validate($data);

        $articleUrl = new ArticleUrl($data["articleUrl"]);
        $originIp = new OriginIp($this->clientIpAddressProvider->getClientIpAddressAsLong());
        return new Command(
            $this->articleDetailsProvider->provideArticleDetails($articleUrl),
            new \DateTimeImmutable(),
            $originIp
        );
    }
}