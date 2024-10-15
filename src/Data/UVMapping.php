<?php

declare(strict_types=1);

namespace BlackBonjour\Mox\Data;

readonly class UVMapping
{
    public function __construct(
        public float $u,
        public float $v,
        public float $u2,
        public float $v2,
    ){}
}
