<?php

declare(strict_types=1);

namespace P7v\SmockerClient\Request;

use Override;

trait GetMethodTrait
{
    #[Override]
    public function getMethod(): string
    {
        return 'GET';
    }
}
