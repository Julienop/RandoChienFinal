<?php

namespace App\Enum;

enum DifficultyEnum: string
{
    case FACILE = 'facile';
    case MOYEN = 'moyen';
    case DIFFICILE = 'difficile';

    public function label(): string
    {
        return match($this) {
            self::FACILE => 'Facile',
            self::MOYEN => 'Moyen',
            self::DIFFICILE => 'Difficile',
        };
    }
}
