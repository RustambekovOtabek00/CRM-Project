<?php

declare(strict_types=1);

namespace App\Controller;

use ApiPlatform\Validator\ValidatorInterface;
use App\Component\Company\CompanyFactory;
use App\Component\Company\CompanyManager;
use App\Entity\Company;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CompanyCreateAction extends AbstractController
{
    public function __invoke(
        Company $data,
        CompanyFactory $factory,
        CompanyManager $manager,
        ValidatorInterface $validator
    ): Company {
        $validator->validate($data);

        $company = $factory->create(
            $data->getName(),
            $data->getPassword(),
            $data->getEmail(),
        );

        $manager->save($company, true);

        return $company;
    }
}
