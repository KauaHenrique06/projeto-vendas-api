<?php

namespace App\Enums;

enum OrderStatus: string
{
    case PENDING = 'pending';
    case FULFILLED = 'fulfilled';
    case CANCELED = 'canceled';
}