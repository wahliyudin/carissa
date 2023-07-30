<?php

namespace App\Enums\Purchase;

enum StatusApprov: int
{
    case MENUNGGU = 1;
    case SETUJU = 2;
    case TOLAK = 3;

    public function badge()
    {
        return match ($this) {
            self::MENUNGGU => '<span class="badge bg-warning">Menunggu</span>',
            self::SETUJU => '<span class="badge bg-success">Setuju</span>',
            self::TOLAK => '<span class="badge bg-danger">Tolak</span>',
        };
    }
}
