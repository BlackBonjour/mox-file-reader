<?php

declare(strict_types=1);

namespace BlackBonjour\Mox\Parser;

use BadMethodCallException;
use BlackBonjour\Mox\BinaryReader;
use BlackBonjour\Mox\Data\Coordinate;
use BlackBonjour\Mox\Data\UVMapping;
use BlackBonjour\Mox\Data\Vertex;
use OutOfBoundsException;

class VertexParser
{
    /**
     * @throws BadMethodCallException
     * @throws OutOfBoundsException
     */
    public function parse(string $data): Vertex
    {
        if (empty($data) || strlen($data) !== 40) {
            throw new BadMethodCallException('Invalid vertex data given!');
        }

        $binaryReader = new BinaryReader($data);

        return new Vertex(
            position : new Coordinate(
                x: $binaryReader->readFloat32bit(),
                y: $binaryReader->readFloat32bit(),
                z: $binaryReader->readFloat32bit(),
            ),
            normal   : new Coordinate(
                x: $binaryReader->readFloat32bit(),
                y: $binaryReader->readFloat32bit(),
                z: $binaryReader->readFloat32bit(),
            ),
            uvMapping: new UVMapping(
                u : $binaryReader->readFloat32bit(),
                v : $binaryReader->readFloat32bit(),
                u2: $binaryReader->readFloat32bit(),
                v2: $binaryReader->readFloat32bit(),
            ),
        );
    }
}
