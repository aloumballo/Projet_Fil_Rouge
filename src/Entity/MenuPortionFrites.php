<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use ApiPlatform\Core\Annotation\ApiResource;
use App\Repository\MenuPortionFritesRepository;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: MenuPortionFritesRepository::class)]
#[ApiResource(


    collectionOperations: ["get", "post" => [

        'denormalization_context' => ['groups' => ['write']]

    ]],
    itemOperations: ["get", "put"]
)]
class MenuPortionFrites
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
   
    private $id;

    // #[ORM\ManyToOne(targetEntity: PortionFrite::class, inversedBy: 'menuPortionFrites')]
    // #[Groups(["write"])]
    // private $quantite;

    #[ORM\ManyToOne(targetEntity: Menu::class, inversedBy: 'menuPortionFrites')]
    // #[Groups(["write"])]
    private $menu;

    #[Assert\Positive(
        message: 'la quantite doit etre positive wane'
    )]
    #[ORM\Column(type: 'integer')]
    #[Groups(["write"])]
    private $quantite;

    #[ORM\ManyToOne(targetEntity: PortionFrite::class, inversedBy: 'menuPortionFrites', cascade:["persist"])]
    #[Groups(["write"])]
    private $portionFrite;

    public function getId(): ?int
    {
        return $this->id;
    }

    // public function getQuantite(): ?PortionFrite
    // {
    //     return $this->quantite;
    // }

    // public function setQuantite(?PortionFrite $quantite): self
    // {
    //     $this->quantite = $quantite;

    //     return $this;
    // }

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