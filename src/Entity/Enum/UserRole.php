<?php

namespace App\Entity\Enum;

enum UserRole: string
{
    case ROLE_ADMIN = 'ROLE_ADMIN';

    public function label(): string
    {
        return match($this) {
            UserRole::ROLE_ADMIN => 'ROLE_ADMIN',
        };
    }
}
