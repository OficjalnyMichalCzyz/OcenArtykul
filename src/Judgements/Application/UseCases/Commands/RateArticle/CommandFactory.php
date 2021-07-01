<?php

namespace RateArticle\Judgements\Application\UseCases\Commands\RateArticle;

use RateArticle\Articles\Infrastructure\ClientIpAddressProvider\ClientIpAddressProvider;
use RateArticle\Judgements\Domain\Body;
use RateArticle\Judgements\Domain\Type;
use RateArticle\SharedKernel\Domain\OriginIp;

class CommandFactory
{
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
     * @param SchemaValidator $schemaValidator
     * @param ClientIpAddressProvider $clientIpAddressProvider
     */
    public function __construct(
        SchemaValidator $schemaValidator,
        ClientIpAddressProvider $clientIpAddressProvider
    )   {
        $this->schemaValidator = $schemaValidator;
        $this->clientIpAddressProvider = $clientIpAddressProvider;
    }

    /**
     * @param array $data
     * @return Command
     * @throws \RateArticle\Judgements\Domain\Exceptions\BodyTooLong
     * @throws \RateArticle\Judgements\Domain\Exceptions\BodyTooShort
     * @throws \RateArticle\Judgements\Domain\Exceptions\TypeValueInvalid
     * @throws \RateArticle\SharedKernel\Application\Exceptions\SchemaError
     * @throws \RateArticle\SharedKernel\Domain\Exceptions\OriginIpInvalid
     */
    public function create(array $data): Command
    {
        $this->schemaValidator->validate($data);

        $type = new Type($data["type"]);
        $judgedArticleId = $data["judgedArticleId"];
        $body = new Body($data["body"]);
        $originIp = new OriginIp($this->clientIpAddressProvider->getClientIpAddressAsLong());
        return new Command(
            $type,
            $judgedArticleId,
            $body,
            $originIp,
            new \DateTimeImmutable()
        );
    }
}