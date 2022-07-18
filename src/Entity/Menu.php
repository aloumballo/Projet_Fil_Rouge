<?php

namespace App\Entity;

use App\Entity\Produit;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\MenuRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

#[ApiResource(
    
    collectionOperations: [
        
        "get",
        
        "post" => [
            'denormalization_context' => ['groups' => ['write']],
        ]
    ],
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

    // #[ORM\ManyToMany(targetEntity: Burger::class, mappedBy: 'menus')]
    // private $burgers;

    // #[ORM\ManyToMany(targetEntity: Boisson::class, inversedBy: 'menus')]
    // #[Groups(["write"])]
    // private $boissons;
    #[Assert\Count(
        min: 1,
        //max: 5,
        minMessage: 'Au moins un burger !!!'
    )]
    #[Assert\Valid()]
    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: MenuBurgers::class,cascade:["persist"])]
    #[Groups(["write"])]
     private $menuBurgers;

    #[Assert\Valid()]
    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: MenuTaille::class,cascade: ["persist"])]
    #[Groups(["write"])]
    private $menuTailles;

    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: MenuPortionFrites::class,cascade: ["persist"])]
    #[Groups(["write"])]
    private $menuPortionFrites;

    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'menus')]
    private $gestionnaire;

    //  #[ORM\ManyToOne(targetEntity: CommandeMenu::class, inversedBy: 'menus')]
    //  private $commandeMenu;
    
    #[ORM\OneToMany(mappedBy: 'menu', targetEntity: CommandeMenu::class)]
    private $commandeMenus;

    // #[ORM\ManyToOne(targetEntity: Commande::class, inversedBy: 'menus')]
    // private $commande;

    /* #[ORM\ManyToOne(targetEntity: Catalogue::class, inversedBy: 'menus')]
    private $catalogue; */



    public function __construct()
    {

       

       
        // $this->complements = new ArrayCollection();
        // $this->burgers = new ArrayCollection();
        // $this->boissons = new ArrayCollection();
        $this->menuBurgers = new ArrayCollection();
        $this->menuTailles = new ArrayCollection();
        $this->menuPortionFrites = new ArrayCollection();
        $this->commandeMenus = new ArrayCollection();


       
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

    // /**
    //  * @return Collection<int, Burger>
    //  */
    // public function getBurgers(): Collection
    // {
    //     return $this->burgers;
    // }

    // public function addBurger(Burger $burger): self
    // {
    //     if (!$this->burgers->contains($burger)) {
    //         $this->burgers[] = $burger;
    //         $burger->addMenu($this);
    //     }

    //     return $this;
    // }

    // public function removeBurger(Burger $burger): self
    // {
    //     if ($this->burgers->removeElement($burger)) {
    //         $burger->removeMenu($this);
    //     }

    //     return $this;
    // }

    /* public function getCatalogue(): ?Catalogue
    {
        return $this->catalogue;
    }

    public function setCatalogue(?Catalogue $catalogue): self
    {
        $this->catalogue = $catalogue;

        return $this;
    // } */

    // /**
    //  * @return Collection<int, Boisson>
    //  */
    // public function getBoissons(): Collection
    // {
    //     return $this->boissons;
    // }

    // public function addBoisson(Boisson $boisson): self
    // {
    //     if (!$this->boissons->contains($boisson)) {
    //         $this->boissons[] = $boisson;
    //     }

    //     return $this;
    // }

    // public function removeBoisson(Boisson $boisson): self
    // {
    //     $this->boissons->removeElement($boisson);

    //     return $this;
    // }

    /**
     * @return Collection<int, MenuBurgers>
     */
    public function getMenuBurgers(): Collection
    {
        return $this->menuBurgers;
    }

    public function addMenuBurger(MenuBurgers $menuBurger): self
    {
        if (!$this->menuBurgers->contains($menuBurger)) {
            $this->menuBurgers[] = $menuBurger;
            $menuBurger->setMenu($this);
        }

        return $this;
    }

    public function removeMenuBurger(MenuBurgers $menuBurger): self
    {
        if ($this->menuBurgers->removeElement($menuBurger)) {
            // set the owning side to null (unless already changed)
            if ($menuBurger->getMenu() === $this) {
                $menuBurger->setMenu(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, MenuTaille>
     */
    public function getMenuTailles(): Collection
    {
        return $this->menuTailles;
    }

    public function addMenuTaille(MenuTaille $menuTaille): self
    {
        if (!$this->menuTailles->contains($menuTaille)) {
            $this->menuTailles[] = $menuTaille;
            $menuTaille->setMenu($this);
        }

        return $this;
    }

    public function removeMenuTaille(MenuTaille $menuTaille): self
    {
        if ($this->menuTailles->removeElement($menuTaille)) {
            // set the owning side to null (unless already changed)
            if ($menuTaille->getMenu() === $this) {
                $menuTaille->setMenu(null);
            }
        }

        return $this;
    }

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
            $menuPortionFrite->setMenu($this);
        }

        return $this;
    }

    public function removeMenuPortionFrite(MenuPortionFrites $menuPortionFrite): self
    {
        if ($this->menuPortionFrites->removeElement($menuPortionFrite)) {
            // set the owning side to null (unless already changed)
            if ($menuPortionFrite->getMenu() === $this) {
                $menuPortionFrite->setMenu(null);
            }
        }

        return $this;
    }

    public function getGestionnaire(): ?Gestionnaire
    {
        return $this->gestionnaire;
    }

    public function setGestionnaire(?Gestionnaire $gestionnaire): self
    {
        $this->gestionnaire = $gestionnaire;

        return $this;
    }

    #[Assert\Callback]
    public function validate(ExecutionContextInterface $context, $payload)
    {

        if (count($this->getMenuTailles())==0 && count($this->getMenuPortionFrites()) == 0) {
            $context->buildViolation('saisir au moins un complement')
                 ->addViolation();
        }
    }

    // public function getCommande(): ?Commande
    // {
    //     return $this->commande;
    // }

    // public function setCommande(?Commande $commande): self
    // {
    //     $this->commande = $commande;

    //     return $this;
    // }

    // public function getCommandeMenu(): ?CommandeMenu
    // {
    //     return $this->commandeMenu;
    // }

    // public function setCommandeMenu(?CommandeMenu $commandeMenu): self
    // {
    //     $this->commandeMenu = $commandeMenu;

    //     return $this;
    // }

    /**
     * @return Collection<int, CommandeMenu>
     */
    public function getCommandeMenus(): Collection
    {
        return $this->commandeMenus;
    }

    public function addCommandeMenu(CommandeMenu $commandeMenu): self
    {
        if (!$this->commandeMenus->contains($commandeMenu)) {
            $this->commandeMenus[] = $commandeMenu;
            $commandeMenu->setMenu($this);
        }

        return $this;
    }

    public function removeCommandeMenu(CommandeMenu $commandeMenu): self
    {
        if ($this->commandeMenus->removeElement($commandeMenu)) {
            // set the owning side to null (unless already changed)
            if ($commandeMenu->getMenu() === $this) {
                $commandeMenu->setMenu(null);
            }
        }

        return $this;
    }
}