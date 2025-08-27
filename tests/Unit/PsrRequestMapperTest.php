<?php

declare(strict_types=1);

namespace P7v\SmockerClient\Tests\Unit;

use GuzzleHttp\Psr7\HttpFactory;
use P7v\SmockerClient\PsrRequestMapper;
use P7v\SmockerClient\Request\ApiRequestInterface;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

#[CoversClass(PsrRequestMapper::class)]
final class PsrRequestMapperTest extends TestCase
{
    private PsrRequestMapper $sut;

    protected function setUp(): void
    {
        parent::setUp();

        $httpFactory = new HttpFactory();

        $this->sut = new PsrRequestMapper(
            $httpFactory,
            $httpFactory,
            $httpFactory,
        );
    }

    #[Test]
    public function it_maps_properly(): void
    {
        $request = new class() implements ApiRequestInterface {
            public function getMethod(): string
            {
                return 'POST';
            }

            public function getRoute(): string
            {
                return '/api/v1/examples';
            }

            public function getQueryParameters(): array
            {
                return [
                    'ping' => 'pong',
                    'test' => 1,
                ];
            }

            public function getBody(): mixed
            {
                return [
                    'foo' => 'bar',
                    'number' => 2,
                ];
            }
        };

        $psrRequest = $this->sut->map($request);


        $this->assertEquals('POST', $psrRequest->getMethod());
        $this->assertEquals('/api/v1/examples?ping=pong&test=1', $psrRequest->getUri());
        $this->assertEquals(
            [
                'Accept' => ['application/json'],
            ],
            $psrRequest->getHeaders(),
        );
        $this->assertEquals('{"foo":"bar","number":2}', $psrRequest->getBody()->getContents());
    }
}
