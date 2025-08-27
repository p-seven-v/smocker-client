<?php

declare(strict_types=1);

namespace P7v\SmockerClient;

use P7v\SmockerClient\Request\ApiRequestInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;
use Psr\Http\Message\UriInterface;

/**
 * @internal
 */
final class PsrRequestMapper
{
    public function __construct(
        private readonly RequestFactoryInterface $requestFactory,
        private readonly UriFactoryInterface $uriFactory,
        private readonly StreamFactoryInterface $streamFactory,
    ) {}

    public function map(ApiRequestInterface $request): RequestInterface
    {
        return $this
            ->requestFactory
            ->createRequest(
                $request->getMethod(),
                $this->createUri($request),
            )
            ->withHeader('Accept', 'application/json')
            ->withBody($this->streamFactory->createStream($this->serializeBody($request->getBody())));
    }

    private function createUri(ApiRequestInterface $request): UriInterface
    {
        $uri = $this
            ->uriFactory
            ->createUri($request->getRoute());

        if ($request->getQueryParameters() === []) {
            return $uri;
        }

        return $uri->withQuery(http_build_query($request->getQueryParameters()));
    }

    private function serializeBody(mixed $body): string
    {
        if ($body === null) {
            return '';
        }

        return json_encode($body, JSON_THROW_ON_ERROR);
    }
}
