<?php

namespace App\Enums\Purchase;

enum Status: int
{
    case DIBUAT = 1;
    case DIPESAN = 2;
    case DITERIMA = 3;
}
