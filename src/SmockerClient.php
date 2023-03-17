<?php

declare(strict_types=1);

namespace P7v\SmockerClient;

use CuyZ\Valinor\Mapper\MappingError;
use CuyZ\Valinor\Mapper\Source\Source;
use CuyZ\Valinor\MapperBuilder;
use P7v\SmockerClient\Request\ApiRequestInterface;
use P7v\SmockerClient\Request\LockMocksRequest;
use P7v\SmockerClient\Request\ResetRequest;
use P7v\SmockerClient\Request\UnlockMocksRequest;
use P7v\SmockerClient\Response\LockMocksResponse;
use P7v\SmockerClient\Response\ResetResponse;
use P7v\SmockerClient\Response\UnlockMocksResponse;
use Psr\Http\Client\ClientExceptionInterface;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

final class SmockerClient
{
    public function __construct(
        private ClientInterface $client,
        private PsrRequestMapper $requestMapper,
    ) {
    }

    public function reset(ResetRequest $resetRequest): ResetResponse
    {
        return $this->performRequest($resetRequest, ResetResponse::class);
    }

    public function lockMocks(LockMocksRequest $lockMocksRequest): LockMocksResponse
    {
        return $this->performRequest($lockMocksRequest, LockMocksResponse::class);
    }

    public function unlockMocks(UnlockMocksRequest $unlockMocksRequest): UnlockMocksResponse
    {
        return $this->performRequest($unlockMocksRequest, UnlockMocksResponse::class);
    }

    /**
     * @template T of object
     *
     * @param class-string<T> $signature
     *
     * @return T
     *
     * @throws MappingError
     * @throws ClientExceptionInterface
     */
    private function performRequest(ApiRequestInterface $request, string $signature): object
    {
        return $this->mapResponse(
            $signature,
            $this->client->sendRequest(
                $this->requestMapper->map($request),
            ),
        );
    }

    /**
     * @template T of object
     *
     * @param class-string<T> $signature
     *
     * @return T
     *
     * @throws MappingError
     */
    private function mapResponse(string $signature, ResponseInterface $response): object
    {
        return (new MapperBuilder())
            ->mapper()
            ->map(
                $signature,
                Source::json((string)$response->getBody()),
            );
    }
}
