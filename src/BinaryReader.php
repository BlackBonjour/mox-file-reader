<?php

declare(strict_types=1);

namespace BlackBonjour\Mox;

use InvalidArgumentException;
use OutOfBoundsException;

class BinaryReader
{
    private readonly int $length;
    private int $pointer;

    public function __construct(
        private readonly string $data,
    ) {
        $this->length  = strlen($data);
        $this->pointer = 0;
    }

    /**
     * @throws OutOfBoundsException
     */
    public function read(int $length, ?int $offset = null): string
    {
        if (($this->pointer + $length) >= $this->length) {
            throw new OutOfBoundsException('Reading past data length!');
        }

        // Move pointer if no custom offset is given
        if ($offset === null) {
            $offset        = $this->pointer;
            $this->pointer += $length;
        }

        return substr($this->data, $offset, $length);
    }

    /**
     * @throws OutOfBoundsException
     */
    public function readFloat32bit(?int $offset = null): float
    {
        $data     = $this->read(4, $offset);
        $unpacked = unpack('f', $data);

        if ($unpacked === false) {
            throw new OutOfBoundsException(sprintf('Cannot read 32bit float from "%s"!', bin2hex($data)));
        }

        return $unpacked[1];
    }

    /**
     * @throws OutOfBoundsException
     */
    public function readUnsigned8bit(?int $offset = null): int
    {
        $data = $this->read(1, $offset);

        return ord($data);
    }

    /**
     * @throws InvalidArgumentException
     * @throws OutOfBoundsException
     */
    public function readUnsigned16bit(?int $offset = null): int
    {
        $data     = $this->read(2, $offset);
        $unpacked = unpack('S', $data);

        if ($unpacked === false) {
            throw new InvalidArgumentException(sprintf('Cannot read 16bit unsigned int from "%s"!', bin2hex($data)));
        }

        return $unpacked[1];
    }

    /**
     * @throws InvalidArgumentException
     * @throws OutOfBoundsException
     */
    public function readUnsigned32bit(?int $offset = null): int
    {
        $data     = $this->read(4, $offset);
        $unpacked = unpack('L', $data);

        if ($unpacked === false) {
            throw new InvalidArgumentException(sprintf('Cannot read 32bit unsigned int from "%s"!', bin2hex($data)));
        }

        return $unpacked[1];
    }
}
