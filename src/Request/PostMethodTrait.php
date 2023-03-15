<?php

declare(strict_types=1);

namespace P7v\SmockerClient\Request;

trait PostMethodTrait
{
    public function getMethod(): string
    {
        return 'POST';
    }
}
