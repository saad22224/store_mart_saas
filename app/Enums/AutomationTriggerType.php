<?php

namespace App\Enums;

enum AutomationTriggerType: string
{
    case AFTER_REGISTRATION = 'after_registration';
    case INACTIVE_USER = 'inactive_user';
    case STORE_CREATED = 'store_created';
    case FIRST_SALE = 'first_sale';
}
