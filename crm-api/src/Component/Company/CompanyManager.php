<?php

declare(strict_types=1);

namespace App\Component\Company;

use App\Entity\Company;
use Doctrine\ORM\EntityManagerInterface;

readonly class CompanyManager
{
    public function __construct(private EntityManagerInterface $manager)
    {
    }

    public function save(Company $company, bool $isNeedFlush = false): void
    {
        $this->manager->persist($company);

        if ($isNeedFlush) {
            $this->manager->flush();
        }
    }
}
