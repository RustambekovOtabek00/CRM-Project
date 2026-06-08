<?php

declare(strict_types=1);

namespace App\Controller;

use ApiPlatform\Validator\ValidatorInterface;
use App\Component\Client\ClientFactory;
use App\Component\Client\ClientManager;
use App\Entity\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClientCreateAction extends AbstractController
{
    public function __invoke(
        Client $data,
        ClientFactory $factory,
        ClientManager $manager,
        ValidatorInterface $validator
    ): Client {
        $validator->validate($data);

        $client = $factory->create(
            $data->getName(),
            $data->getEmail(),
            $data->getPassword(),
            $data->getCompany()
        );

        $manager->save($client, true);

        return $client;
    }
}
