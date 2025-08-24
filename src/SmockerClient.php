<?php

declare(strict_types=1);

namespace P7v\SmockerClient;

use CuyZ\Valinor\Mapper\MappingError;
use CuyZ\Valinor\Mapper\Source\Exception\InvalidSource;
use CuyZ\Valinor\Mapper\Source\Source;
use CuyZ\Valinor\MapperBuilder;
use P7v\SmockerClient\Request\GetMocksRequest;
use P7v\SmockerClient\Request\HealthcheckRequest;
use P7v\SmockerClient\Request\ResetRequest;
use P7v\SmockerClient\Response\HealthcheckResponse;
use P7v\SmockerClient\Response\MocksResponse;
use P7v\SmockerClient\Response\ResetResponse;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * @api
 */
final class SmockerClient
{
    public function __construct(
        private ClientInterface $client,
        private PsrRequestMapper $requestMapper,
    ) {}

    public function reset(ResetRequest $resetRequest): ResetResponse
    {
        $response = $this->client->sendRequest(
            $this->requestMapper->map($resetRequest),
        );

        return $this->mapResponse(ResetResponse::class, $response);
    }

    public function getMocks(GetMocksRequest $getMocksRequest): MocksResponse
    {
        $response = $this->client->sendRequest(
            $this->requestMapper->map($getMocksRequest),
        );

        try {
            return $this->mapResponse(MocksResponse::class, $response);
        } catch (MappingError $error) {
            $messages = $error->messages();

            foreach ($messages as $message) {
                var_dump($message);
            }

            die;
        }
    }

    public function healthcheck(HealthcheckRequest $healthcheckRequest): HealthcheckResponse
    {
        $response = $this->client->sendRequest(
            $this->requestMapper->map($healthcheckRequest),
        );

        try {
            return $this->mapResponse(HealthcheckResponse::class, $response);
        } catch (MappingError $error) {
            $messages = $error->messages();

            foreach ($messages as $message) {
                echo $message;
                echo "\n";
            }

            die;
        }
    }

    /**
     * @template T of object
     *
     * @param class-string<T> $signature
     *
     * @return T
     *
     * @throws MappingError
     * @throws InvalidSource
     */
    private function mapResponse(string $signature, ResponseInterface $response): object
    {
        return (new MapperBuilder())
            ->allowSuperfluousKeys()
            ->allowUndefinedValues()
            ->mapper()
            ->map(
                $signature,
                Source::json(trim((string)$response->getBody()))
                    ->camelCaseKeys(),
            );
    }
}
