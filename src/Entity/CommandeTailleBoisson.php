<?php

namespace App\Entity;

use App\Entity\Produit;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use App\Repository\CommandeTailleBoissonRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: CommandeTailleBoissonRepository::class)]
#[ApiResource]
class CommandeTailleBoisson
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

    #[ORM\ManyToOne(targetEntity: Commande::class, inversedBy: 'commandeTailleBoissons')]
    private $commande;

    #[Groups(["Commande:read", "Commande:write"])]
    #[ORM\ManyToOne(targetEntity: TailleBoisson::class, inversedBy: 'commandeTailleBoissons')]
    private $tailleBoisson;

    // #[ORM\Column(type: 'float')]
    // private $prix;

    // #[ORM\OneToMany(mappedBy: 'commandeTailleBoisson', targetEntity: Commande::class)]
    // private $commandes;

    // #[Groups(["Commande:read", "Commande:write"])]
    // #[ORM\OneToMany(mappedBy: 'commandeTailleBoisson', targetEntity: TailleBoisson::class)]
    // private $tailleBoissons;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
        $this->tailleBoissons = new ArrayCollection();
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
    //         $commande->setCommandeTailleBoisson($this);
    //     }

    //     return $this;
    // }

    // public function removeCommande(Commande $commande): self
    // {
    //     if ($this->commandes->removeElement($commande)) {
    //         // set the owning side to null (unless already changed)
    //         if ($commande->getCommandeTailleBoisson() === $this) {
    //             $commande->setCommandeTailleBoisson(null);
    //         }
    //     }

    //     return $this;
    // }

    /**
     * @return Collection<int, TailleBoisson>
     */
    public function getTailleBoissons(): Collection
    {
        return $this->tailleBoissons;
    }

    // public function addTailleBoisson(TailleBoisson $tailleBoisson): self
    // {
    //     if (!$this->tailleBoissons->contains($tailleBoisson)) {
    //         $this->tailleBoissons[] = $tailleBoisson;
    //         $tailleBoisson->setCommandeTailleBoisson($this);
    //     }

    //     return $this;
    // }

    // public function removeTailleBoisson(TailleBoisson $tailleBoisson): self
    // {
    //     if ($this->tailleBoissons->removeElement($tailleBoisson)) {
    //         // set the owning side to null (unless already changed)
    //         if ($tailleBoisson->getCommandeTailleBoisson() === $this) {
    //             $tailleBoisson->setCommandeTailleBoisson(null);
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

    public function getTailleBoisson(): ?TailleBoisson
    {
        return $this->tailleBoisson;
    }

    public function setTailleBoisson(?TailleBoisson $tailleBoisson): self
    {
        $this->tailleBoisson = $tailleBoisson;

        return $this;
    }
}