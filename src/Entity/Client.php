<?php

namespace App\Entity;

use App\Entity\Gestionnaire;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ClientRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

#[ApiResource]
// (
//     normalizationContext: ["groups" => ["user:read"]],
//     denormalizationContext: ["groups" => ["user:write"]]
// )]


#[ORM\Entity(repositoryClass: ClientRepository::class)]
class Client extends User
{
    // #[ORM\Id]
    // #[ORM\GeneratedValue]
    // #[ORM\Column(type: 'integer')]
    // private $id;

    #[ORM\Column(type: 'string', length: 20)]
    private $adresse;



    #[ORM\OneToMany(mappedBy: 'client', targetEntity: Commande::class)]
    private $commandes;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
        $this->setRoles(["ROLE_CLIENT"]);
    }

    // public function getId(): ?int
    // {
    //     return $this->id;
    // }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->setClient($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            // set the owning side to null (unless already changed)
            if ($commande->getClient() === $this) {
                $commande->setClient(null);
            }
        }

        return $this;
    }
}