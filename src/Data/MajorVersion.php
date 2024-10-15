<?php

declare(strict_types=1);

namespace BlackBonjour\Mox\Data;

enum MajorVersion: int
{
    case V0 = 0; // 16bit indices
    case V1 = 1; // 32bit indices
    case V2 = 2; // 32bit indices + tangent
}
