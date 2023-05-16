<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PAID = 'PAID';
    case NOT_PAID = 'NOT_PAID';
}
