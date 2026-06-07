<?php

namespace App\Enums;

enum RedemptionStatus: string
{
    case PENDING = 'pending';

    case APPROVED = 'approved';
    case REJECTED = 'rejected';
}
