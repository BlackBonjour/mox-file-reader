<?php

declare(strict_types=1);

namespace BlackBonjour\Mox\Data;

enum MinorVersion: int
{
    case V2   = 2; // \x00\x02 - 32bit chunks
    case V256 = 256; // \x01\x00 - 16bit chunks
    case V514 = 514; // \x02\x02 - 32bit chunks, parts, lights
    case V515 = 515; // \x02\x03 - Unknown format, used in Crash Time 5 - Undercover
}
