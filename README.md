# Smocker API Client

[![Latest Version on Packagist](https://img.shields.io/packagist/v/p7v/smocker-client.svg?style=flat)](https://packagist.org/packages/p7v/smocker-client)

API client for [Smocker HTTP mock server](https://smocker.dev).

# Usage

```php
<?php

declare(strict_types=1);

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\HttpFactory;
use P7v\SmockerClient\PsrRequestMapper;
use P7v\SmockerClient\Request\GetMocksRequest;
use P7v\SmockerClient\Request\HealthcheckRequest;
use P7v\SmockerClient\SmockerClient;use P7v\SmockerClient\SmockerClientFactory;

require __DIR__ . '/vendor/autoload.php';

$httpClient = new Client(); // This can be ANY client that is PSR-18 compliant

$client = SmockerClientFactory::create($httpClient);
```
