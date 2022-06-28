<?php

/**
 * UserServiceInterface.
 */

namespace App\Service;

use App\Entity\User;

/**
 * Interface UserServiceInterface.
 */
interface UserServiceInterface
{
    /**
     * Save.
     *
     * @param User $user
     *
     * @return void
     */
    public function save(User $user): void;
}
