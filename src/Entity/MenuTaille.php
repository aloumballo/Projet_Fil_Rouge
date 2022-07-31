<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MenuTailleRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


#[ApiResource(

    collectionOperations: [
        "get", "post" => [

            'denormalization_context' => ['groups' => ['wr']]
        ]
    ],

    itemOperations: ["get", "put"]

)]

#[ORM\Entity(repositoryClass: MenuTailleRepository::class)]
class MenuTaille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["Burger:read:all", "Burger:read:simple"])]
    private $id;

    #[ORM\ManyToOne(targetEntity: Taille::class, inversedBy:'menuTailles', cascade: ["persist"])]
    #[Groups(["wr", "write"])]
    private $taille;


   
    #[ORM\ManyToOne(targetEntity: Menu::class, inversedBy: 'menuTailles',cascade: ["persist"])]
    private $menu;

    #[Assert\Positive(
        message: 'la quantite doit etre positive wane'
    )]
    #[ORM\Column(type: 'integer')]
    #[Groups(["wr", "write"])]
    private $quantite;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): self
    {
        $this->menu = $menu;

        return $this;
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
}