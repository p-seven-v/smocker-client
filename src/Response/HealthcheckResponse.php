<?php

declare(strict_types=1);

namespace P7v\SmockerClient\Response;

use DateTimeImmutable;

/**
 * @api
 */
final class HealthcheckResponse
{
    public function __construct(
        public readonly string $appName,
        public readonly string $buildVersion,
        public readonly string $buildCommit,
        public readonly DateTimeImmutable $buildDate,
    ) {}

}
