<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\CommandeBurgerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;

use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: CommandeBurgerRepository::class)]
#[ApiResource]
class CommandeBurger
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[Groups(["Commande:write"])]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Assert\Positive(
        message: 'la quantite doit etre positive wane'
    )]
    #[Groups(["Commande:write"])]
    #[ORM\Column(type: 'integer')]
    private $quantite;

    //#[Assert\Valid]
    #[Groups(["Commande:read"])]
    #[ORM\ManyToOne(targetEntity: Commande::class, inversedBy: 'commandeBurgers')]
    private $commande;

    #[Groups(["Commande:write"])]
    #[ORM\ManyToOne(targetEntity: Burger::class, inversedBy: 'commandeBurgers')]
    private $burger;

    // #[Groups(["Commande:write"])]
    // #[ORM\OneToMany(mappedBy: 'commandeBurger', targetEntity: Burger::class)]
    // private $burgers;
    
    // #[Assert\Valid]
    // // #[Groups(["Commande:read", "Commande:write"])]
    // #[ORM\OneToMany(mappedBy: 'commandeBurger', targetEntity: Commande::class)]
    // private $commandes;

    public function __construct()
    {
        $this->burgers = new ArrayCollection();
        $this->commandes = new ArrayCollection();
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

    /**
     * @return Collection<int, Burger>
     */
    public function getBurgers(): Collection
    {
        return $this->burgers;
    }

    // public function addBurger(Burger $burger): self
    // {
    //     if (!$this->burgers->contains($burger)) {
    //         $this->burgers[] = $burger;
    //         $burger->setCommandeBurger($this);
    //     }

    //     return $this;
    // }

    // public function removeBurger(Burger $burger): self
    // {
    //     if ($this->burgers->removeElement($burger)) {
    //         // set the owning side to null (unless already changed)
    //         if ($burger->getCommandeBurger() === $this) {
    //             $burger->setCommandeBurger(null);
    //         }
    //     }

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
    //         $commande->setCommandeBurger($this);
    //     }

    //     return $this;
    // }

    // public function removeCommande(Commande $commande): self
    // {
    //     if ($this->commandes->removeElement($commande)) {
    //         // set the owning side to null (unless already changed)
    //         if ($commande->getCommandeBurger() === $this) {
    //             $commande->setCommandeBurger(null);
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

    public function getBurger(): ?Burger
    {
        return $this->burger;
    }

    public function setBurger(?Burger $burger): self
    {
        $this->burger = $burger;

        return $this;
    }
}