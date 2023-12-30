<?php

namespace App\Enum\Rune;

enum Type: string
{
    case ASSAULT_FIXED   = 'ASSAULT_FIXED';
    case ASSAULT_PERCENT = 'ASSAULT_PERCENT';
    case VITAL_FIXED     = 'VITAL_FIXED';
    case VITAL_PERCENT   = 'VITAL_PERCENT';
    case SHIELD          = 'SHIELD';
    case FATAL           = 'FATAL';
    case RAGE            = 'RAGE';
}