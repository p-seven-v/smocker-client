<?php

declare(strict_types=1);

namespace P7v\SmockerClient\Request;

trait GetMethodTrait
{
    public function getMethod(): string
    {
        return 'GET';
    }
}
