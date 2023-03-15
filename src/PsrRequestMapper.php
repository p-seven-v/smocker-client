<?php

declare(strict_types=1);

namespace P7v\SmockerClient;

use P7v\SmockerClient\Request\ApiRequestInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\UriFactoryInterface;

final class PsrRequestMapper
{
    public function __construct(
        private RequestFactoryInterface $requestFactory,
        private UriFactoryInterface $uriFactory,
        private StreamFactoryInterface $streamFactory,
    ) {
    }

    public function map(ApiRequestInterface $request): RequestInterface
    {
        return $this
            ->requestFactory
            ->createRequest(
                $request->getMethod(),
                $this
                    ->uriFactory
                    ->createUri($request->getRoute())
                    ->withQuery(http_build_query($request->getQueryParameters())),
            )
            ->withBody($this->streamFactory->createStream($this->serializeBody($request->getBody())));
    }

    private function serializeBody(mixed $body): string
    {
        if ($body === null) {
            return '';
        }

        return json_encode($body, JSON_THROW_ON_ERROR);
    }
}
