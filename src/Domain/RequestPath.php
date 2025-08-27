<?php

declare(strict_types=1);

namespace P7v\SmockerClient\Domain;

/**
 * @api
 */
final class RequestPath {
    public function __construct(
        public readonly string $value,
        public readonly string $matcher = 'ShouldEqual',
    ) {}

}
