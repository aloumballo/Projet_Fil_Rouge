<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\MenuBurgersRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


#[ApiResource(


    collectionOperations:["get","post"=>[

        'denormalization_context' => ['groups' => ['write']]
        
    ]],
    itemOperations:["get","put"]
)]
#[ORM\Entity(repositoryClass: MenuBurgersRepository::class)]
class MenuBurgers
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["Burger:read:all", "write", "Burger:read:simple"])]
    private $id;


    #[Assert\Positive(
        message: 'la quantite doit etre positive wane'
    )]
    #[ORM\Column(type: 'integer')]
    #[Groups(["Burger:read:all", "write", "Burger:read:simple"])]
    private $quantite;

   
    #[ORM\ManyToOne(targetEntity: Menu::class, inversedBy: 'menuBurgers')]
    private $menu;

    #[ORM\ManyToOne(targetEntity: Burger::class, inversedBy: 'menuBurgers',cascade: ["persist"])]
    #[Groups(["write"])]
    private $burger;

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

    public function getMenu(): ?Menu
    {
        return $this->menu;
    }

    public function setMenu(?Menu $menu): self
    {
        $this->menu = $menu;

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