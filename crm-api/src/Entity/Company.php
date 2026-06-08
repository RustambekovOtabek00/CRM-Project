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
use App\Controller\CompanyCreateAction;
use App\Controller\DeleteAction;
use App\Entity\Interfaces\DeletedSettableInterface;
use App\Repository\CompanyRepository;
use App\State\CompanyCollectionProvider;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Attribute\Groups;
use Symfony\Component\Validator\Constraints as Assert;

#[ORM\Entity(repositoryClass: CompanyRepository::class)]
#[ApiResource(
    operations: [
        new GetCollection(
            provider: CompanyCollectionProvider::class
        ),
        new Get(),
        new Post(
            uriTemplate: 'companies',
            controller: CompanyCreateAction::class,
            validate: false,
            name: "createCompany",
        ),
        new Patch(),
        new Delete(
            controller: DeleteAction::class,
        ),
    ],
    normalizationContext: ['groups' => ['company:read']],
    denormalizationContext: ['groups' => ['company:write']],
)]
#[ApiFilter(SearchFilter::class, properties: [
    'name' => 'partial',
    'email' => 'partial',
    'password' => 'partial',

])]
class Company implements DeletedSettableInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    #[Groups(['company:read'])]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Groups(['company:read', 'company:write', 'client:read'])]
    private ?string $name = null;

    #[ORM\Column(length: 255)]
    #[Assert\Email()]
    #[Groups(['company:read', 'company:write'])]
    private ?string $email = null;

    #[ORM\Column(length: 255)]
    #[Assert\NotBlank]
    #[Assert\Length(min: 4, max: 20)]
    #[Groups(['company:read', 'company:write'])]
    private ?string $password = null;

    /**
     * @var Collection<int, Client>
     */
    #[ORM\OneToMany(targetEntity: Client::class, mappedBy: 'company')]
    private Collection $clients;

    #[ORM\Column(nullable: true)]
    #[Groups(['company:read'])]
    private ?DateTime $lastSeen = null;

    #[ORM\Column(nullable: true)]
    private ?bool $isDeleted = null;

    public function __construct()
    {
        $this->clients = new ArrayCollection();
    }

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

    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @return Collection<int, Client>
     */
    public function getClients(): Collection
    {
        return $this->clients;
    }

    public function addClient(Client $client): static
    {
        if (!$this->clients->contains($client)) {
            $this->clients->add($client);
            $client->setCompany($this);
        }

        return $this;
    }

    public function removeClient(Client $client): static
    {
        if ($this->clients->removeElement($client)) {
            // set the owning side to null (unless already changed)
            if ($client->getCompany() === $this) {
                $client->setCompany(null);
            }
        }

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
