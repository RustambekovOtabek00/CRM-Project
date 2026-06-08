<?php

declare(strict_types=1);

namespace App\Component\Company;

use App\Entity\Company;
use DateTime;
use DateTimeZone;

readonly class CompanyFactory
{
    public function create(
        string $userName,
        string $password,
        string $email,
    ): Company {
        $company = new Company();

        $company->setName($userName)
            ->setPassword($password)
            ->setEmail($email)
            ->setLastSeen(
                new DateTime('now', new DateTimeZone('Asia/Tashkent'))
            );

        return $company;
    }
}
