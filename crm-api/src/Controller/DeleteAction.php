<?php

declare(strict_types=1);

namespace App\Controller;

use App\Entity\Interfaces\DeletedSettableInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DeleteAction extends AbstractController
{
    public function __construct(private EntityManagerInterface $entityManager)
    {}

    public function __invoke(DeletedSettableInterface $data,): void
    {
        $this->setIsDeleted($data, true);
    }

    public function setIsDeleted(DeletedSettableInterface $entity, bool $needToFlush = false): void
    {
        $entity->setIsDeleted(true);

        $this->entityManager->persist($entity);

        if ($needToFlush) {
            $this->entityManager->flush();
        }
    }
}
