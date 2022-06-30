<?php

namespace App\Entity;

use App\Entity\Produit;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MenuRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

#[ApiResource(
    collectionOperations: ["get", "post"],
    itemOperations: ["put", "get"]
)]
#[ORM\Entity(repositoryClass: MenuRepository::class)]
class Menu extends Produit
{
    // #[ORM\Id]
    // #[ORM\GeneratedValue]
    // #[ORM\Column(type: 'integer')]
    // private $id;

    // #[ORM\ManyToMany(targetEntity: Complement::class, mappedBy: 'menus')]
    // private $complements;

    #[ORM\ManyToMany(targetEntity: Burger::class, mappedBy: 'menus')]
    private $burgers;

    #[ORM\ManyToMany(targetEntity: Boisson::class, inversedBy: 'menus')]
    private $boissons;

    /* #[ORM\ManyToOne(targetEntity: Catalogue::class, inversedBy: 'menus')]
    private $catalogue; */



    public function __construct()
    {
        // $this->complements = new ArrayCollection();
        $this->burgers = new ArrayCollection();
        $this->boissons = new ArrayCollection();
    }

    // public function getId(): ?int
    // {
    //     return $this->id;
    // }

    // /**
    //  * @return Collection<int, Complement>
    //  */
    // public function getComplements(): Collection
    // {
    //     return $this->complements;
    // }

    // public function addComplement(Complement $complement): self
    // {
    //     if (!$this->complements->contains($complement)) {
    //         $this->complements[] = $complement;
    //         $complement->addMenu($this);
    //     }

    //     return $this;
    // }

    // public function removeComplement(Complement $complement): self
    // {
    //     if ($this->complements->removeElement($complement)) {
    //         $complement->removeMenu($this);
    //     }

    //     return $this;
    // }

    /**
     * @return Collection<int, Burger>
     */
    public function getBurgers(): Collection
    {
        return $this->burgers;
    }

    public function addBurger(Burger $burger): self
    {
        if (!$this->burgers->contains($burger)) {
            $this->burgers[] = $burger;
            $burger->addMenu($this);
        }

        return $this;
    }

    public function removeBurger(Burger $burger): self
    {
        if ($this->burgers->removeElement($burger)) {
            $burger->removeMenu($this);
        }

        return $this;
    }

    /* public function getCatalogue(): ?Catalogue
    {
        return $this->catalogue;
    }

    public function setCatalogue(?Catalogue $catalogue): self
    {
        $this->catalogue = $catalogue;

        return $this;
    } */

    /**
     * @return Collection<int, Boisson>
     */
    public function getBoissons(): Collection
    {
        return $this->boissons;
    }

    public function addBoisson(Boisson $boisson): self
    {
        if (!$this->boissons->contains($boisson)) {
            $this->boissons[] = $boisson;
        }

        return $this;
    }

    public function removeBoisson(Boisson $boisson): self
    {
        $this->boissons->removeElement($boisson);

        return $this;
    }
}