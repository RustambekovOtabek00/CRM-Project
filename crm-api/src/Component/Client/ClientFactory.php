<?php

declare(strict_types=1);

namespace App\Component\Client;

use App\Entity\Client;
use App\Entity\Company;
use DateTime;
use DateTimeZone;

readonly class ClientFactory
{
    public function create(
        string $userName,
        string $email,
        string $password,
        Company $company
    ): Client {
        $client = new Client();

        $client->setName($userName)
            ->setPassword($password)
            ->setEmail($email)
            ->setCompany($company)
            ->setLastSeen(
                new DateTime('now', new DateTimeZone('Asia/Tashkent'))
            );

        return $client;
    }
}
