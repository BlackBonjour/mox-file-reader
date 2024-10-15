<?php

declare(strict_types=1);

namespace BlackBonjour\Mox;

use BadMethodCallException;
use BlackBonjour\Mox\Data\Header;
use BlackBonjour\Mox\Parser\HeaderParser;
use BlackBonjour\Mox\Parser\VertexParser;
use InvalidArgumentException;
use OutOfBoundsException;
use ValueError;

readonly class MoxParser
{
    public function __construct(
        private HeaderParser $headerParser,
        private VertexParser $vertexParser,
    ) {}

    /**
     * @throws BadMethodCallException
     * @throws InvalidArgumentException
     * @throws OutOfBoundsException
     */
    public function parse(string $data): void
    {
        $binaryReader = new BinaryReader($data);

        // Parse and validate header
        try {
            $header = $this->headerParser->parse($binaryReader->read(32));
        } catch (ValueError) {
            throw new InvalidArgumentException(
                sprintf(
                    'Unsupported MOX version %d.%d!',
                    $binaryReader->readUnsigned8bit(4),
                    $binaryReader->readUnsigned16bit(6),
                ),
            );
        }

        if ($header->startTag !== Header::START_TAG) {
            throw new InvalidArgumentException('Unsupported MOX format!');
        }

        if ($header->a !== 0) {
            throw new InvalidArgumentException('Unsupported MOX format!');
        }

        // Parse vertices
        $vertices = [];

        for ($i = 0; $i < $header->amountVertices; $i++) {
            $vertices[$i] = $this->vertexParser->parse($binaryReader->read(40));
        }
    }
}
