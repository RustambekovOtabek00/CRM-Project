<?php

declare(strict_types=1);

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Repository\ClientRepository;

class ClientCollectionProvider implements ProviderInterface
{
    public function __construct(
        private ClientRepository $repository
    ) {
    }

    public function provide(
        Operation $operation,
        array $uriVariables = [],
        array $context = []
    ): array {
        $qb = $this->repository->findActiveClients();

        if (!empty($context['filters']['name'])) {
            $qb->andWhere('c.name LIKE :name')
                ->setParameter('name', '%' . $context['filters']['name'] . '%');
        }

        if (!empty($context['filters']['email'])) {
            $qb->andWhere('c.email LIKE :email')
                ->setParameter('email', '%' . $context['filters']['email'] . '%');
        }

        return $qb->getQuery()->getResult();
    }
}
