<?php

namespace App\Entity;

use ApiPlatform\Doctrine\Orm\Filter\SearchFilter;
use ApiPlatform\Metadata\ApiFilter;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Controller\ClientCreateAction;
use App\Controller\DeleteAction;
use App\Entity\Interfaces\DeletedSettableInterface;
use App\Repository\ClientRepository;
use App\State\ClientCollectionProvider;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: ClientRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(
            provider: ClientCollectionProvider::class
        ),
        new Get(),
        new Post(
            uriTemplate: 'clients',
            controller: ClientCreateAction::class,
            validate: false,
            name: "createClient",
        ),
        new Patch(),
        new Delete(
            controller: DeleteAction::class,
        ),
    ],
    normalizationContext: ['groups' => ['client:read']],
    denormalizationContext: ['groups' => ['client:write']],
)]
#[ApiFilter(SearchFilter::class, properties: [
    'name' => 'partial',
    'email' => 'partial',
    'password' => 'partial',

])]
class Client implements DeletedSettableInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['client:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Groups(['client:read', 'client:write'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\Email()]
    #[Groups(['client:read', 'client:write'])]
    private ?string $email = null;

    #[ORM\ManyToOne(inversedBy: 'clients')]
    #[ORM\JoinColumn(nullable: false)]
    #[Groups(['client:read', 'client:write'])]
    private ?Company $company = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 4, max: 20)]
    #[Groups(['client:read', 'client:write'])]
    private ?string $password = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['client:read'])]
    private ?DateTime $lastSeen = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isDeleted = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): static
    {
        $this->company = $company;

        return $this;
    }

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    public function getLastSeen(): ?DateTime
    {
        return $this->lastSeen;
    }

    public function setLastSeen(?DateTime $lastSeen): static
    {
        $this->lastSeen = $lastSeen;

        return $this;
    }

    public function isDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(?bool $isDeleted): static
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }
}
