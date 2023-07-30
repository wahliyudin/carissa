<?php

namespace App\Enums\Purchase;

enum Status: int
{
    case DIBUAT = 1;
    case DIPESAN = 2;
    case DITERIMA = 3;

    public function badge()
    {
        return match ($this) {
            self::DIBUAT => '<span class="badge bg-info">Dibuat</span>',
            self::DIPESAN => '<span class="badge bg-primary">Dipesan</span>',
            self::DITERIMA => '<span class="badge bg-success">Diterima</span>',
        };
    }
}
