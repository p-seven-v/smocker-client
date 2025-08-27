<?php

declare(strict_types=1);

namespace P7v\SmockerClient;

use GuzzleHttp\Psr7\HttpFactory;
use Psr\Http\Client\ClientInterface;

/**
 * @api
 */
final class SmockerClientFactory
{
    public static function create(
        ClientInterface $client,
    ): SmockerClient {
        $factory = new HttpFactory();

        return new SmockerClient(
            $client,
            new PsrRequestMapper(
                $factory,
                $factory,
                $factory,
            ),
        );
    }
}
