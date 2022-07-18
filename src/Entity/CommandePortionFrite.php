<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\CommandePortionFriteRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: CommandePortionFriteRepository::class)]
#[ApiResource]
class CommandePortionFrite
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Assert\Positive(
        message: 'la quantite doit etre positive wane'
    )]
    #[Groups(["Commande:write"])]
    #[ORM\Column(type: 'integer')]
    private $quantite;

    #[ORM\ManyToOne(targetEntity: Commande::class, inversedBy: 'commandePortionFrites')]
    private $commande;

    #[Groups(["Commande:read", "Commande:write"])]
    #[ORM\ManyToOne(targetEntity: PortionFrite::class, inversedBy: 'commandePortionFrites')]
    private $portionFrite;

    // #[ORM\Column(type: 'float')]
    // private $prix;

    // #[ORM\OneToMany(mappedBy: 'commandePortionFrite', targetEntity: Commande::class)]
    // private $commandes;

    // #[Groups(["Commande:read", "Commande:write"])]
    // #[ORM\OneToMany(mappedBy: 'commandePortionFrite', targetEntity: PortionFrite::class)]
    // private $portionFrites;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
        $this->portionFrites = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?int
    {
        return $this->quantite;
    }

    public function setQuantite(int $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    // public function getPrix(): ?float
    // {
    //     return $this->prix;
    // }

    // public function setPrix(float $prix): self
    // {
    //     $this->prix = $prix;

    //     return $this;
    // }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    // public function addCommande(Commande $commande): self
    // {
    //     if (!$this->commandes->contains($commande)) {
    //         $this->commandes[] = $commande;
    //         $commande->setCommandePortionFrite($this);
    //     }

    //     return $this;
    // }

    // public function removeCommande(Commande $commande): self
    // {
    //     if ($this->commandes->removeElement($commande)) {
    //         // set the owning side to null (unless already changed)
    //         if ($commande->getCommandePortionFrite() === $this) {
    //             $commande->setCommandePortionFrite(null);
    //         }
    //     }

    //     return $this;
    // }

    /**
     * @return Collection<int, PortionFrite>
     */
    public function getPortionFrites(): Collection
    {
        return $this->portionFrites;
    }

    // public function addPortionFrite(PortionFrite $portionFrite): self
    // {
    //     if (!$this->portionFrites->contains($portionFrite)) {
    //         $this->portionFrites[] = $portionFrite;
    //         $portionFrite->setCommandePortionFrite($this);
    //     }

    //     return $this;
    // }

    // public function removePortionFrite(PortionFrite $portionFrite): self
    // {
    //     if ($this->portionFrites->removeElement($portionFrite)) {
    //         // set the owning side to null (unless already changed)
    //         if ($portionFrite->getCommandePortionFrite() === $this) {
    //             $portionFrite->setCommandePortionFrite(null);
    //         }
    //     }

    //     return $this;
    // }

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

        return $this;
    }

    public function getPortionFrite(): ?PortionFrite
    {
        return $this->portionFrite;
    }

    public function setPortionFrite(?PortionFrite $portionFrite): self
    {
        $this->portionFrite = $portionFrite;

        return $this;
    }
}