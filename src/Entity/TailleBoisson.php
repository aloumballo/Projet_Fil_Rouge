<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TailleBoissonRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: TailleBoissonRepository::class)]
#[ApiResource]
class TailleBoisson
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[Groups(["Commande:write"])]
    #[ORM\Column(type: 'integer')]
    private $id;

    //#[Groups(["Produit"])]
    #[ORM\Column(type: 'float')]
    private $quantite;

    // #[Groups(["Commande:write"])]
    #[ORM\ManyToOne(targetEntity: Boisson::class, inversedBy: 'tailleBoissons')]
    private $boisson;

    // #[Groups(["Commande:write"])]
    #[ORM\ManyToOne(targetEntity: Taille::class, inversedBy: 'tailleBoissons')]
    private $taille;

    #[ORM\ManyToOne(targetEntity: CommandeTailleBoisson::class, inversedBy: 'tailleBoissons')]
    private $commandeTailleBoisson;

    // #[ORM\ManyToOne(targetEntity: Boisson::class, inversedBy: 'tailleBoissons')]
    // private $boisson;

    // #[ORM\ManyToOne(targetEntity: Taille::class, inversedBy: 'tailleBoissons')]
    // private $taille;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getQuantite(): ?float
    {
        return $this->quantite;
    }

    public function setQuantite(float $quantite): self
    {
        $this->quantite = $quantite;

        return $this;
    }

    // public function getBoisson(): ?Boisson
    // {
    //     return $this->boisson;
    // }

    // public function setBoisson(?Boisson $boisson): self
    // {
    //     $this->boisson = $boisson;

    //     return $this;
    // }

    // public function getTaille(): ?Taille
    // {
    //     return $this->taille;
    // }

    // public function setTaille(?Taille $taille): self
    // {
    //     $this->taille = $taille;

    //     return $this;
    // }

    public function getBoisson(): ?Boisson
    {
        return $this->boisson;
    }

    public function setBoisson(?Boisson $boisson): self
    {
        $this->boisson = $boisson;

        return $this;
    }

    public function getTaille(): ?Taille
    {
        return $this->taille;
    }

    public function setTaille(?Taille $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getCommandeTailleBoisson(): ?CommandeTailleBoisson
    {
        return $this->commandeTailleBoisson;
    }

    public function setCommandeTailleBoisson(?CommandeTailleBoisson $commandeTailleBoisson): self
    {
        $this->commandeTailleBoisson = $commandeTailleBoisson;

        return $this;
    }
}