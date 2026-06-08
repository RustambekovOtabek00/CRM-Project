<?php

declare(strict_types=1);

namespace App\Component\User;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;

readonly class UserManager
{
    public function __construct(private EntityManagerInterface $manager)
    {}

    public function save(User $user, bool $isNeedFlush = false): void
    {
        $this->manager->persist($user);

        if ($isNeedFlush) {
            $this->manager->flush();
        }
    }
}