<?php

namespace App\Entity;

use App\Entity\Produit;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BoissonRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;

#[ApiResource(
    collectionOperations: ["get", "post"],
    itemOperations: ["put", "get"]
)]

#[ORM\Entity(repositoryClass: BoissonRepository::class)]
class Boisson extends Produit
{
    #[ORM\OneToMany(mappedBy: 'boisson', targetEntity: TailleBoisson::class)]
    private $tailleBoissons;

    // #[ORM\OneToMany(mappedBy: 'boisson', targetEntity: TailleBoisson::class)]
    // private $tailleBoissons;

    // #[ORM\Id]
    // #[ORM\GeneratedValue]
    // #[ORM\Column(type: 'integer')]
    // private $id;

    // #[ORM\ManyToMany(targetEntity: Taille::class, mappedBy: 'boissons')]
    // private $tailles;

    // #[ORM\ManyToMany(targetEntity: Menu::class, mappedBy: 'boissons')]
    // private $menus;

    public function __construct()
    {
        // $this->tailles = new ArrayCollection();
        // $this->menus = new ArrayCollection();
        // $this->tailleBoissons = new ArrayCollection();
    }

    // public function getId(): ?int
    // {
    //     return $this->id;
    // }

    // /**
    //  * @return Collection<int, Taille>
    //  */
    // public function getTailles(): Collection
    // {
    //     return $this->tailles;
    // }

    // public function addTaille(Taille $taille): self
    // {
    //     if (!$this->tailles->contains($taille)) {
    //         $this->tailles[] = $taille;
    //         $taille->addBoisson($this);
    //     }

    //     return $this;
    // }

    // public function removeTaille(Taille $taille): self
    // {
    //     if ($this->tailles->removeElement($taille)) {
    //         $taille->removeBoisson($this);
    //     }

    //     return $this;
    // }

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
    //         $menu->addBoisson($this);
    //     }

    //     return $this;
    // }

    // public function removeMenu(Menu $menu): self
    // {
    //     if ($this->menus->removeElement($menu)) {
    //         $menu->removeBoisson($this);
    //     }

    //     return $this;
    // }

    // /**
    //  * @return Collection<int, TailleBoisson>
    //  */
    // public function getTailleBoissons(): Collection
    // {
    //     return $this->tailleBoissons;
    // }

    // public function addTailleBoisson(TailleBoisson $tailleBoisson): self
    // {
    //     if (!$this->tailleBoissons->contains($tailleBoisson)) {
    //         $this->tailleBoissons[] = $tailleBoisson;
    //         $tailleBoisson->setBoisson($this);
    //     }

    //     return $this;
    // }

    // public function removeTailleBoisson(TailleBoisson $tailleBoisson): self
    // {
    //     if ($this->tailleBoissons->removeElement($tailleBoisson)) {
    //         // set the owning side to null (unless already changed)
    //         if ($tailleBoisson->getBoisson() === $this) {
    //             $tailleBoisson->setBoisson(null);
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

    public function addTailleBoisson(TailleBoisson $tailleBoisson): self
    {
        if (!$this->tailleBoissons->contains($tailleBoisson)) {
            $this->tailleBoissons[] = $tailleBoisson;
            $tailleBoisson->setBoisson($this);
        }

        return $this;
    }

    public function removeTailleBoisson(TailleBoisson $tailleBoisson): self
    {
        if ($this->tailleBoissons->removeElement($tailleBoisson)) {
            // set the owning side to null (unless already changed)
            if ($tailleBoisson->getBoisson() === $this) {
                $tailleBoisson->setBoisson(null);
            }
        }

        return $this;
    }
}