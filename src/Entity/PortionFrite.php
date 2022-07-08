<?php

namespace App\Entity;

use App\Entity\Produit;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PortionFriteRepository;
use ApiPlatform\Core\Annotation\ApiResource;

#[ApiResource]


#[ORM\Entity(repositoryClass: PortionFriteRepository::class)]
class PortionFrite extends Produit
{
    #[ORM\OneToMany(mappedBy: 'portionFrite', targetEntity: MenuPortionFrites::class)]
    private $menuPortionFrites;

    /*  #[ORM\OneToMany(mappedBy: 'quantite', targetEntity: MenuPortionFrites::class)]
    private $menuPortionFrites;
 */
    public function __construct()
    {
        parent::__construct();
        //$this->menuPortionFrites = new ArrayCollection();
    }

    // #[ORM\Id]
    // #[ORM\GeneratedValue]
    // #[ORM\Column(type: 'integer')]
    // private $id;

    // public function getId(): ?int
    // {
    //     return $this->id;
    // }

    /**
     * @return Collection<int, MenuPortionFrites>
     */
    /*  public function getMenuPortionFrites(): Collection
    {
        return $this->menuPortionFrites;
    } */

    /*  public function addMenuPortionFrite(MenuPortionFrites $menuPortionFrite): self
    {
        if (!$this->menuPortionFrites->contains($menuPortionFrite)) {
            $this->menuPortionFrites[] = $menuPortionFrite;
            $menuPortionFrite->setQuantite($this);
        }

        return $this;
    }

    public function removeMenuPortionFrite(MenuPortionFrites $menuPortionFrite): self
    {
        if ($this->menuPortionFrites->removeElement($menuPortionFrite)) {
            // set the owning side to null (unless already changed)
            if ($menuPortionFrite->getQuantite() === $this) {
                $menuPortionFrite->setQuantite(null);
            }
        }

        return $this;
    } */

    /**
     * @return Collection<int, MenuPortionFrites>
     */
    public function getMenuPortionFrites(): Collection
    {
        return $this->menuPortionFrites;
    }

    public function addMenuPortionFrite(MenuPortionFrites $menuPortionFrite): self
    {
        if (!$this->menuPortionFrites->contains($menuPortionFrite)) {
            $this->menuPortionFrites[] = $menuPortionFrite;
            $menuPortionFrite->setPortionFrite($this);
        }

        return $this;
    }

    public function removeMenuPortionFrite(MenuPortionFrites $menuPortionFrite): self
    {
        if ($this->menuPortionFrites->removeElement($menuPortionFrite)) {
            // set the owning side to null (unless already changed)
            if ($menuPortionFrite->getPortionFrite() === $this) {
                $menuPortionFrite->setPortionFrite(null);
            }
        }

        return $this;
    }
}