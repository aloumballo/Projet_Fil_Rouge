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
            'denormalization_context' => ['groups' => ["Burger:write:simple"]],
        ],
        "post"
    ],

    itemOperations: [
        "put" => [
            "security" => "is_granted('ROLE_GESTIONNAIRE')",
            "security" => "Vous n'avez pas access à cette Ressource",
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
    #[Groups(["Burger:read:simple"])]
    // #[ORM\Id]
    // #[ORM\GeneratedValue]
    // #[ORM\Column(type: 'integer')]
    // // protected $id;

    #[ORM\ManyToMany(targetEntity: Menu::class, inversedBy: 'burgers')]
    private $menus;

    #[Groups(["Burger:read:simple", "Burger:write:simple", "Burger:read:all"])]
    #[ORM\ManyToOne(targetEntity: User::class, inversedBy: 'burgers')]
    private $user;

    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'burgers')]
    #[Groups(["Burger:read:simple", "Burger:write:simple", "Burger:read:all"])]
    private $gestionnaire;

    /* #[ORM\ManyToOne(targetEntity: Catalogue::class, inversedBy: 'burgers')]
    private $catalogue; */



    // #[ORM\Column(type: 'string', length: 255)]
    // private $test;

    public function __construct()
    {
        $this->menus = new ArrayCollection();
    }

    // public function getId(): ?int
    // {
    //     return $this->id;
    // }

    /**
     * @return Collection<int, Menu>
     */
    public function getMenus(): Collection
    {
        return $this->menus;
    }

    public function addMenu(Menu $menu): self
    {
        if (!$this->menus->contains($menu)) {
            $this->menus[] = $menu;
        }

        return $this;
    }

    public function removeMenu(Menu $menu): self
    {
        $this->menus->removeElement($menu);

        return $this;
    }

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

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

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
}