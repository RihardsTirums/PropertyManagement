<?php

namespace App\Enums;

class PropertyStatusEnum
{
    const PURCHASE_AGREEMENT = 'Purchase Agreement';
    const PAID = 'Paid';
    const REGISTERED_IN_LAND_BOOK = 'Registered in the Land Book';
    const SOLD = 'Sold';

    public static function getStatusOptions(): array
    {
        return [
            self::PURCHASE_AGREEMENT => 'Purchase Agreement',
            self::PAID => 'Paid',
            self::REGISTERED_IN_LAND_BOOK => 'Registered in the Land Book',
            self::SOLD => 'Sold',
        ];
    }
}

