<?php

namespace App\Enums;

class LandUseEnum
{
    const AGRICULTURAL_LAND = 'Agricultural Land';
    const FOREST_LAND = 'Forest Land';
    const LAND_UNDER_WATER = 'Land Under Water';
    const BUILT_UP_AREA = 'Built-Up Area';

    public static function getLandUseOptions(): array
    {
        return [
            self::AGRICULTURAL_LAND => self::AGRICULTURAL_LAND,
            self::FOREST_LAND => self::FOREST_LAND,
            self::LAND_UNDER_WATER => self::LAND_UNDER_WATER,
            self::BUILT_UP_AREA => self::BUILT_UP_AREA,
        ];
    }
}
