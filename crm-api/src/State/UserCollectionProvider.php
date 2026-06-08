<?php

declare(strict_types=1);

namespace App\State;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use App\Repository\UserRepository;

class UserCollectionProvider implements ProviderInterface
{
    public function __construct(
        private UserRepository $repository
    ) {
    }

    public function provide(
        Operation $operation,
        array $uriVariables = [],
        array $context = []
    ): array {
        $qb = $this->repository->findActiveUsers();

        if (!empty($context['filters']['name'])) {
            $qb->andWhere('u.name LIKE :name')
                ->setParameter('name', '%' . $context['filters']['name'] . '%');
        }

        if (!empty($context['filters']['email'])) {
            $qb->andWhere('u.email LIKE :email')
                ->setParameter('email', '%' . $context['filters']['email'] . '%');
        }

        return $qb->getQuery()->getResult();
    }
}
