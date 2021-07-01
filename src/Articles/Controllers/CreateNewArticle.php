<?php

namespace RateArticle\Articles\Controllers;

use JsonException;
use RateArticle\Articles\Application\UseCases\Commands\AddNewArticle\CommandFactory;
use RateArticle\Articles\Application\UseCases\Commands\AddNewArticle\Handler;
use RateArticle\SharedKernel\Application\Exceptions\SchemaError;
use RateArticle\SharedKernel\Controllers\HttpController;
use RateArticle\SharedKernel\Domain\Exceptions\ValidationError;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

final class CreateNewArticle extends HttpController
{
    private Handler $handler;
    private CommandFactory $commandFactory;

    /**
     * CreateNewArticle constructor.
     * @param Handler $handler
     * @param CommandFactory $commandFactory
     */
    public function __construct(Handler $handler, CommandFactory $commandFactory)
    {
        $this->handler = $handler;
        $this->commandFactory = $commandFactory;
    }

    public function run(Request $request): Response
    {
        try {
            $requestData = $this->extractJsonDataFromRequest($request);
            $command = $this->commandFactory->create($requestData);
            $article = $this->handler->handle($command);
        } catch (JsonException $e) {
            return $this->createResponse(400, json_encode(["error" => "invalid_json"]));
        } catch (ValidationError $e) {
            return $this->createResponse(422, json_encode(["error" => $e->getMessage()]));
        } catch (SchemaError $e) {
            return $this->createResponse(400, json_encode(["error" => $e->getMessage()]));
        }
        return $this->createResponse(201, json_encode(["id" => $article->identifier()]));
    }
}