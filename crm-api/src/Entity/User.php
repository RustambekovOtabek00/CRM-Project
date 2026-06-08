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
use ApiPlatform\Metadata\QueryParameter;
use App\Controller\DeleteAction;
use App\Controller\UserChangeAction;
use App\Controller\UserCreateAction;
use App\Entity\Interfaces\DeletedSettableInterface;
use App\Repository\UserRepository;
use App\State\UserCollectionProvider;
use DateTime;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(
            provider: UserCollectionProvider::class
        ),
        new Get(),
        new Post(
            uriTemplate: 'users',
            controller: UserCreateAction::class,
            validate: false,
            name: "createUser",
        ),
        new Patch(
            uriTemplate: "users/update",
            controller: UserChangeAction::class,
            validate: false,
            name: "update",
            parameters: [
                "id" => new QueryParameter(schema: ['type' => 'integer'])
            ]
        ),
        new Delete(
            controller: DeleteAction::class,
        ),
        new Post(
            uriTemplate: 'users/auth',
            name: 'auth',
        )
    ],
    normalizationContext: ['groups' => ['user:read']],
    denormalizationContext: ['groups' => ['user:write']],
    paginationItemsPerPage: 10
)]
#[UniqueEntity(['email'], "Bu email allaqachon ro'yxatdan o'tgan!")]
#[ApiFilter(SearchFilter::class, properties: [
    'name' => 'partial',
    'email' => 'partial'

])]
class User implements PasswordAuthenticatedUserInterface, UserInterface,
                      DeletedSettableInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['user:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user:read', 'user:write'])]
    #[Assert\NotBlank]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user:read', 'user:write'])]
    #[Assert\Email()]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Groups(['user:write'])]
    #[Assert\NotBlank]
    #[Assert\Length(min: 4)]
    private ?string $password = null;

    #[ORM\Column(nullable: true)]
    #[Groups(['user:read'])]
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

    public function getRoles(): array
    {
        return ['ROLE_USER'];
    }

    public function eraseCredentials(): void
    {
    }

    public function getUserIdentifier(): string
    {
        return $this->getEmail();
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

    public function getIsDeleted(): ?bool
    {
        return $this->isDeleted;
    }

    public function setIsDeleted(?bool $isDeleted): static
    {
        $this->isDeleted = $isDeleted;

        return $this;
    }
}
