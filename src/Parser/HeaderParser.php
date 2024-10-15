<?php

declare(strict_types=1);

namespace BlackBonjour\Mox\Parser;

use BadMethodCallException;
use BlackBonjour\Mox\BinaryReader;
use BlackBonjour\Mox\Data\Header;
use BlackBonjour\Mox\Data\MajorVersion;
use BlackBonjour\Mox\Data\MinorVersion;
use InvalidArgumentException;
use OutOfBoundsException;
use ValueError;

class HeaderParser
{
    /**
     * @throws BadMethodCallException
     * @throws InvalidArgumentException
     * @throws OutOfBoundsException
     * @throws ValueError
     */
    public function parse(string $data): Header
    {
        if (empty($data) || strlen($data) !== 32) {
            throw new BadMethodCallException('Invalid MOX file header given!');
        }

        $binaryReader = new BinaryReader($data);

        return new Header(
            startTag       : $binaryReader->read(4),
            majorVersion   : MajorVersion::from($binaryReader->readUnsigned8bit()),
            a              : $binaryReader->readUnsigned8bit(1),
            minorVersion   : MinorVersion::from($binaryReader->readUnsigned16bit()),
            amountVertices : $binaryReader->readUnsigned32bit(),
            amountPolygons : $binaryReader->readUnsigned32bit(),
            amountChunks   : $binaryReader->readUnsigned32bit(),
            amountMaterials: $binaryReader->readUnsigned32bit(),
            amountParts    : $binaryReader->readUnsigned32bit(),
            amountLights   : $binaryReader->readUnsigned32bit(),
        );
    }
}
