<?php

/**
 * UserService.
 */

namespace App\Service;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

/**
 * Class UserService.
 */
class UserService implements UserServiceInterface
{
    /**
     * UserRepository.
     *
     * @var UserRepository User repository
     */
    private UserRepository $userRepository;

    /**
     * UserPasswordHasherInterface.
     *
     * @var UserPasswordHasherInterface User password hasher interface
     */
    private UserPasswordHasherInterface $hasher;

    /**
     * Constructor.
     *
     * @param UserRepository              $userRepository User repository
     * @param UserPasswordHasherInterface $hasher         User password hasher interface
     */
    public function __construct(UserRepository $userRepository, UserPasswordHasherInterface $hasher)
    {
        $this->userRepository = $userRepository;
        $this->hasher = $hasher;
    }

    /**
     * Save.
     *
     * @param User $user User Entity
     */
    public function save(User $user): void
    {
        $user->setPassword($this->hasher->hashPassword($user, $user->getPassword()));
        $this->userRepository->save($user);
    }
}
