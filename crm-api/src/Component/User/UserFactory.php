<?php

declare(strict_types=1);

namespace App\Component\User;

use App\Entity\User;
use DateTime;
use DateTimeZone;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

readonly class UserFactory
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHarsher
    ) {
    }

    public function create(
        string $userName,
        string $password,
        string $email,
    ): User {
        $user = new User();

        $hashedPassword = $this->passwordHarsher->hashPassword(
            $user,
            $password
        );

        $user->setName($userName)
            ->setPassword($hashedPassword)
            ->setEmail($email)
            ->setLastSeen(
                new DateTime('now', new DateTimeZone('Asia/Tashkent'))
            );

        return $user;
    }
}
