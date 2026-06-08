<?php

declare(strict_types=1);

namespace App\Component\Client;

use App\Entity\Client;
use Doctrine\ORM\EntityManagerInterface;

readonly class ClientManager
{
    public function __construct(private EntityManagerInterface $manager)
    {
    }

    public function save(Client $client, bool $isNeedFlush = false): void
    {
        $this->manager->persist($client);

        if ($isNeedFlush) {
            $this->manager->flush();
        }
    }
}
