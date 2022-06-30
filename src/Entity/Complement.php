<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\ComplementRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
#[ApiResource]

// #[ORM\Entity(repositoryClass: ComplementRepository::class)]
class Complement
{
    // #[ORM\Id]
    // #[ORM\GeneratedValue]
    // #[ORM\Column(type: 'integer')]
    private $id;
    private $tailles;
    private $portionFrites;

    // #[ORM\ManyToMany(targetEntity: Menu::class, inversedBy: 'complements')]
    // private $menus;

    // public function __construct()
    // {
    //     $this->menus = new ArrayCollection();
    // }

    public function getId(): ?int
    {
        return $this->id;
    }

    // /**
    //  * @return Collection<int, Menu>
    //  */
    // public function getMenus(): Collection
    // {
    //     return $this->menus;
    // }

    // public function addMenu(Menu $menu): self
    // {
    //     if (!$this->menus->contains($menu)) {
    //         $this->menus[] = $menu;
    //     }

    //     return $this;
    // }

    // public function removeMenu(Menu $menu): self
    // {
    //     $this->menus->removeElement($menu);

    //     return $this;
    // }

    /**
     * Get the value of tailles
     */ 
    public function getTailles()
    {
        return $this->tailles;
    }

    /**
     * Set the value of tailles
     *
     * @return  self
     */ 
    public function setTailles($tailles)
    {
        $this->tailles = $tailles;

        return $this;
    }

    /**
     * Get the value of portionFrites
     */ 
    public function getPortionFrites()
    {
        return $this->portionFrites;
    }

    /**
     * Set the value of portionFrites
     *
     * @return  self
     */ 
    public function setPortionFrites($portionFrites)
    {
        $this->portionFrites = $portionFrites;

        return $this;
    }
}