<?php

namespace App\DataFixtures;

use App\Entity\Enum\UserRole;
use App\Entity\User;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends AbstractBaseFixtures
{
    private UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }

    protected function loadData(): void
    {

        $this->createMany(1, 'admin', function ($i) {
            $user = new User();
            $user->setUsername('admin');
            $user->setRoles([UserRole::ROLE_ADMIN->value]);
            $user->setPassword(
                $this->hasher->hashPassword(
                    $user,
                    'admin1234',
                )
            );
            return $user;
        });
        $this->manager->flush();
    }

}