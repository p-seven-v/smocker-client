<?php

declare(strict_types=1);

namespace P7v\SmockerClient\Response;

use ArrayIterator;
use IteratorAggregate;
use P7v\SmockerClient\Domain\Mock;
use Traversable;

/**
 * @implements IteratorAggregate<Mock>
 */
final class MocksResponse implements IteratorAggregate
{
    /**
     * @param list<Mock> $mocks
     */
    public function __construct(
        public readonly array $mocks,
    ) {}

    public function getIterator(): Traversable
    {
        return new ArrayIterator($this->mocks);
    }
}
