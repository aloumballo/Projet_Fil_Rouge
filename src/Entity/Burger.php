<?php

namespace App\Entity;

use App\Entity\Produit;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\BurgerRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ORM\Entity(repositoryClass: BurgerRepository::class)]
#[ApiResource(
    collectionOperations: [
        "get" => [
            'method' => 'get',
            'path' => '/burgers',
            'status' => Response::HTTP_OK,
            'normalization_context' => ['groups' => ["Burger:read:simple"]],

        ],
        "post" => [
            "security" => "is_granted('ROLE_GESTIONNAIRE')",

            "security_message" => "Vous n'avez pas access à cette Ressource",
            'normalization_context' => ['groups' => ["Burger:read:simple"]],
            'denormalization_context' => ['groups' => ['s:write', 'Produitt']]

        ]
    ],

    itemOperations: [
        "put" => [

            "security" => "is_granted('ROLE_GESTIONNAIRE')",

            "security_message" => "Vous n'avez pas access à cette Ressource",
        ],
        "get" => [
            'method' => 'get',
            'status' => Response::HTTP_OK,
            'normalization_context' => ['groups' => ['Burger:read:all']],
        ]
    ]
)]





class Burger extends Produit
{
    // #[Groups(["Burger:read:simple"])]
    // #[ORM\Id]
    // #[ORM\GeneratedValue]
    // #[ORM\Column(type: 'integer')]
    // // protected $id;

    // #[ORM\ManyToMany(targetEntity: Menu::class, inversedBy: 'burgers')]
    // // #[Groups(["Burger:read:simple", "Burger:write:simple", "Burger:read:all"])]
    // private $menus;

    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'burgers')]
    #[Groups(["Burger:read:all", "s:write", "Burger:read:simple", 'Produitt'])]
    private $gestionnaire;

    #[ORM\OneToMany(mappedBy: 'burger', targetEntity: MenuBurgers::class)]
    private $menuBurgers;

    #[ORM\ManyToOne(targetEntity: CommandeBurger::class, inversedBy: 'burgers')]
    private $commandeBurger;

    #[ORM\OneToMany(mappedBy: 'burger', targetEntity: CommandeBurger::class)]
    private $commandeBurgers;



    /* #[ORM\ManyToOne(targetEntity: Catalogue::class, inversedBy: 'burgers')]
    private $catalogue; */



    // #[ORM\Column(type: 'string', length: 255)]
    // private $test;

    public function __construct()
    {
        $this->menus = new ArrayCollection();
        $this->menuBurgers = new ArrayCollection();
        $this->commandeBurgers = new ArrayCollection();
    }

    // public function getId(): ?int
    // {
    //     return $this->id;
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
    //     }

    //     return $this;
    // }

    // public function removeMenu(Menu $menu): self
    // {
    //     $this->menus->removeElement($menu);

    //     return $this;
    // }

    // public function getTest(): ?string
    // {
    //     return $this->test;
    // }

    // public function setTest(string $test): self
    // {
    //     $this->test = $test;

    //     return $this;
    // }

    /*   public function getCatalogue(): ?Catalogue
    {
        return $this->catalogue;
    }

    public function setCatalogue(?Catalogue $catalogue): self
    {
        $this->catalogue = $catalogue;

        return $this;
    }
 */

    public function getGestionnaire(): ?Gestionnaire
    {
        return $this->gestionnaire;
    }

    public function setGestionnaire(?Gestionnaire $gestionnaire): self
    {
        $this->gestionnaire = $gestionnaire;

        return $this;
    }

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
            $menuBurger->setBurger($this);
        }

        return $this;
    }

    public function removeMenuBurger(MenuBurgers $menuBurger): self
    {
        if ($this->menuBurgers->removeElement($menuBurger)) {
            // set the owning side to null (unless already changed)
            if ($menuBurger->getBurger() === $this) {
                $menuBurger->setBurger(null);
            }
        }

        return $this;
    }

    public function getCommandeBurger(): ?CommandeBurger
    {
        return $this->commandeBurger;
    }

    public function setCommandeBurger(?CommandeBurger $commandeBurger): self
    {
        $this->commandeBurger = $commandeBurger;

        return $this;
    }

    /**
     * @return Collection<int, CommandeBurger>
     */
    public function getCommandeBurgers(): Collection
    {
        return $this->commandeBurgers;
    }

    public function addCommandeBurger(CommandeBurger $commandeBurger): self
    {
        if (!$this->commandeBurgers->contains($commandeBurger)) {
            $this->commandeBurgers[] = $commandeBurger;
            $commandeBurger->setBurger($this);
        }

        return $this;
    }

    public function removeCommandeBurger(CommandeBurger $commandeBurger): self
    {
        if ($this->commandeBurgers->removeElement($commandeBurger)) {
            // set the owning side to null (unless already changed)
            if ($commandeBurger->getBurger() === $this) {
                $commandeBurger->setBurger(null);
            }
        }

        return $this;
    }
}