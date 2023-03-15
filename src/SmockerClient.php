<?php

declare(strict_types=1);

namespace P7v\SmockerClient;

use CuyZ\Valinor\Mapper\Source\Source;
use CuyZ\Valinor\MapperBuilder;
use P7v\SmockerClient\Request\ResetRequest;
use P7v\SmockerClient\Response\ResetResponse;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriFactoryInterface;

final class SmockerClient
{
    public function __construct(
        private ClientInterface $client,
        private PsrRequestMapper $requestMapper,
    ) {
    }

    public function reset(ResetRequest $resetRequest): ResetResponse
    {
        $response = $this->client->sendRequest(
            $this->requestMapper->map($resetRequest),
        );

        return $this->mapResponse(ResetResponse::class, $response);
    }

    /**
     * @param class-string $signature
     */
    private function mapResponse(string $signature, ResponseInterface $response): mixed
    {
        return (new MapperBuilder())
            ->mapper()
            ->map(
                $signature,
                Source::json((string)$response->getBody())
            );

    }
}
