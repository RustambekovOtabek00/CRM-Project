<?php declare(strict_types=1);

namespace App\Entity\Interfaces;

use DateTimeInterface;

interface DeletedSettableInterface
{
    public function setIsDeleted(bool $isDeleted): self;
}
