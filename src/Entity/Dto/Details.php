<?php

namespace App\Entity\Dto;



use Doctrine\ORM\Mapping as ORM;
use App\Repository\DetailsRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations:[],
    itemOperations: [
        "get" => [
            'method' => 'get',
            'path' => '/details/{id}',
            'status' => Response::HTTP_OK,
            "normalization_context" => ["groups" => ["details"]],
        ],

    ],
)]

#[ORM\Entity(repositoryClass: DetailsRepository::class)]

class Details
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(["details"])]

    public $id;

    // #[ORM\Column(type: 'object')]
    #[Groups(["details"])]
    public $menu;

    //#[ORM\Column(type: 'object')]
    #[Groups(["details"])]
    public $burger;

    #[Groups(["details"])]
    public $taille;

    #[Groups(["details"])]
    public $portion;




    public function __construct()
    {
        $this->taille = new ArrayCollection();
        $this->portion = new ArrayCollection();
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMenu(): ?object
    {
        return $this->menu;
    }

    public function setMenu(object $menu): self
    {
        $this->menu = $menu;

        return $this;
    }

    public function getBurger(): ?object
    {
        return $this->burger;
    }

    public function setBurger(object $burger): self
    {
        $this->burger = $burger;

        return $this;
    }

    /**
     * Get the value of taille
     */
    public function getTaille()
    {
        return $this->taille;
    }

    /**
     * Set the value of taille
     *
     * @return  self
     */
    public function setTaille($taille)
    {
        $this->taille = $taille;

        return $this;
    }

    /**
     * Get the value of portion
     */
    public function getPortion()
    {
        return $this->portion;
    }

    /**
     * Set the value of portion
     *
     * @return  self
     */
    public function setPortion($portion)
    {
        $this->portion = $portion;

        return $this;
    }

    /**
     * Set the value of id
     *
     * @return  self
     */
    public function setId($id)
    {
        $this->id = $id;

        return $this;
    }
}