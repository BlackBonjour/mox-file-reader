<?php

declare(strict_types=1);

namespace BlackBonjour\Mox\Data;

readonly class Vertex
{
    public function __construct(
        public Coordinate $position,
        public Coordinate $normal,
        public UVMapping $uvMapping,
    ) {}
}
