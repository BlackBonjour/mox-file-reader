<?php

declare(strict_types=1);

namespace BlackBonjour\Mox\Data;

/**
 * MOX file header is structured as described below:
 *
 * Start tag        4 bytes String      Always !XOM
 * Major version    8bit    Unsigned
 * <unknown>        8bit    Unsigned
 * Minor version    16bit   Unsigned
 * Amount vertices  32bit   Unsigned
 * Amount polygons  32bit   Unsigned
 * Amount chunks    32bit   Unsigned
 * Amount materials 32bit   Unsigned
 * Amount parts     32bit   Unsigned
 * Amount lights    32bit   Unsigned
 *
 * @see MajorVersion
 * @see MinorVersion
 */
readonly class Header
{
    public const string START_TAG = '!XOM';

    public function __construct(
        public string $startTag,
        public MajorVersion $majorVersion,
        public int $a,
        public MinorVersion $minorVersion,
        public int $amountVertices,
        public int $amountPolygons,
        public int $amountChunks,
        public int $amountMaterials,
        public int $amountParts,
        public int $amountLights,
    ) {}
}
