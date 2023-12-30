<?php

namespace App\Enum\Rune;

enum Rarity: string
{
    case COMMON = 'COMMON';
    case RARE   = 'RARE';
    case EPIC   = 'EPIC';
    case LEGEND = 'LEGEND';
}