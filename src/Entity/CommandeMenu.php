<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommandeMenuRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;


#[ORM\Entity(repositoryClass: CommandeMenuRepository::class)]
#[ApiResource]
class CommandeMenu
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[Assert\Positive(
        message: 'la quantite doit etre positive wane'
    )]
    #[Groups(["Commande:write"])]
    #[ORM\Column(type: 'integer')]
    private $quantite;

    #[ORM\ManyToOne(targetEntity: Commande::class, inversedBy: 'commandeMenus')]
    private $commande;

    #[Groups(["Commande:write"])]
    #[ORM\ManyToOne(targetEntity: Menu::class, inversedBy: 'commandeMenus')]
    private $menu;

    // #[ORM\Column(type: 'float')]
    // private $prix;

    //  #[ORM\OneToMany(mappedBy: 'commandeMenu', targetEntity: Commande::class)]
    //  private $commandes;
    //  #[Groups(["Commande:write"])]
    //  #[ORM\OneToMany(mappedBy: 'commandeMenu', targetEntity: Menu::class)]
    //  private $menus;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
        $this->menus = new ArrayCollection();
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

    // public function getPrix(): ?float
    // {
    //     return $this->prix;
    // }

    // public function setPrix(float $prix): self
    // {
    //     $this->prix = $prix;

    //     return $this;
    // }

    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }




    // supppppppppppppp

//    public function addCommande(Commande $commande): self
//    {
//        if (!$this->commandes->contains($commande)) {
//            $this->commandes[] = $commande;
//            $commande->setCommandeMenu($this);
//        }
//        return $this;
//    }
//    public function removeCommande(Commande $commande): self
//    {
//        if ($this->commandes->removeElement($commande)) {
//            // set the owning side to null (unless already changed)
//            if ($commande->getCommandeMenu() === $this) {
//                $commande->setCommandeMenu(null);
//            }
//        }
//        return $this;
//    }
    // dszdzsczc

    /**
     * @return Collection<int, Menu>
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }




    // dzfkjazfezkjfeazf

    //  public function addMenu(Menu $menu): self
    //  {
    //      if (!$this->menus->contains($menu)) {
    //          $this->menus[] = $menu;
    //          $menu->setCommandeMenu($this);
    //      }
    //      return $this;
    //  }
    //  public function removeMenu(Menu $menu): self
    //  {
    //      if ($this->menus->removeElement($menu)) {
    //          // set the owning side to null (unless already changed)
    //          if ($menu->getCommandeMenu() === $this) {
    //              $menu->setCommandeMenu(null);
    //          }
    //      }
    //      return $this;
    //  }




    // qhfqifcq

    public function getCommande(): ?Commande
    {
        return $this->commande;
    }

    public function setCommande(?Commande $commande): self
    {
        $this->commande = $commande;

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
}