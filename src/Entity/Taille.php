<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\TailleRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations: [

        "get" => [
            'denormalization_context' => ['groups' => ['wr']],
        ],

        "post" => [
            'denormalization_context' => ['groups' => ['wri']],
        ]
    ],
    itemOperations: ["put", "get"]
)]
#[ORM\Entity(repositoryClass: TailleRepository::class)]
class Taille
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[Groups(["Commande:write","write"])]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    #[Groups(["wri", "wr"])]
    private $prix;

    #[ORM\Column(type: 'string', length: 20)]
    #[Groups(["wri", "wr"])]
    private $libelle;

    // #[ORM\ManyToMany(targetEntity: Boisson::class, inversedBy: 'tailles')]
    // private $boissons;

    #[ORM\OneToMany(mappedBy: 'taille', targetEntity: MenuTaille::class, cascade: ["persist"])]
    private $menuTailles;

    #[ORM\OneToMany(mappedBy: 'taille', targetEntity: TailleBoisson::class, cascade: ["persist"])]
    private $tailleBoissons;

    // #[ORM\OneToMany(mappedBy: 'taille', targetEntity: TailleBoisson::class)]
    // private $tailleBoissons;

    public function __construct()
    {
      //  $this->boissons = new ArrayCollection();
        $this->menuTailles = new ArrayCollection();
        //$this->tailleBoissons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

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

    // /**
    //  * @return Collection<int, MenuTaille>
    //  */
    // public function getMenuTailles(): Collection
    // {
    //     return $this->menuTailles;
    // }

    // public function addMenuTaille(MenuTaille $menuTaille): self
    // {
    //     if (!$this->menuTailles->contains($menuTaille)) {
    //         $this->menuTailles[] = $menuTaille;
    //         $menuTaille->setTaille($this);
    //     }

    //     return $this;
    // }

    // public function removeMenuTaille(MenuTaille $menuTaille): self
    // {
    //     if ($this->menuTailles->removeElement($menuTaille)) {
    //         // set the owning side to null (unless already changed)
    //         if ($menuTaille->getTaille() === $this) {
    //             $menuTaille->setTaille(null);
    //         }
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
    //         $tailleBoisson->setTaille($this);
    //     }

    //     return $this;
    // }

    // public function removeTailleBoisson(TailleBoisson $tailleBoisson): self
    // {
    //     if ($this->tailleBoissons->removeElement($tailleBoisson)) {
    //         // set the owning side to null (unless already changed)
    //         if ($tailleBoisson->getTaille() === $this) {
    //             $tailleBoisson->setTaille(null);
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
            $tailleBoisson->setTaille($this);
        }

        return $this;
    }

    public function removeTailleBoisson(TailleBoisson $tailleBoisson): self
    {
        if ($this->tailleBoissons->removeElement($tailleBoisson)) {
            // set the owning side to null (unless already changed)
            if ($tailleBoisson->getTaille() === $this) {
                $tailleBoisson->setTaille(null);
            }
        }

        return $this;
    }
}