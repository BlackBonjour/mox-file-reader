<?php

declare(strict_types=1);

namespace BlackBonjour\Mox\Data;

readonly class Coordinate
{
    public function __construct(
        public float $x,
        public float $y,
        public float $z,
    ) {}
}
