<?php

namespace App\Entity;

use App\Entity\Menu;
use App\Entity\Burger;
use App\Entity\Boisson;
use App\Entity\Commande;
use App\Entity\PortionFrite;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\ProduitRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource]

#[ORM\Entity(repositoryClass: ProduitRepository::class)]

#[ORM\Table(name: 'produit')]
#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "type", type: "string")]
#[ORM\DiscriminatorMap([
    "produit" => Produit::class,
    "burger" => Burger::class,
    "menu" => Menu::class,
    "boisson" => Boisson::class,
    "portionFrite" => PortionFrite::class
])]
class Produit
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['Burger:read:simple'])]
    protected $id;

    #[ORM\Column(type: 'string', length: 20)]
    #[Groups(['Burger:read:simple', 'Burger:write:simple', 'Burger:read:all'])]
    protected $nom;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    #[Groups(['Burger:read:simple', 'Burger:write:simple', 'Burger:read:all'])]
    protected $image;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['Burger:read:simple', 'Burger:write:simple', 'Burger:read:all'])]
    protected $prix;

    #[ORM\ManyToMany(targetEntity: Commande::class, mappedBy: 'produits')]
    private $commandes;

    #[ORM\Column(type: 'boolean')]
    #[Groups(['Burger:read:all'])]
    protected $isEtat;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getImage(): ?string
    {
        return $this->image;
    }

    public function setImage(string $image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getPrix(): ?int
    {
        return $this->prix;
    }

    public function setPrix(?int $prix): self
    {
        $this->prix = $prix;

        return $this;
    }



    /**
     * @return Collection<int, Commande>
     */
    public function getCommandes(): Collection
    {
        return $this->commandes;
    }

    public function addCommande(Commande $commande): self
    {
        if (!$this->commandes->contains($commande)) {
            $this->commandes[] = $commande;
            $commande->addProduit($this);
        }

        return $this;
    }

    public function removeCommande(Commande $commande): self
    {
        if ($this->commandes->removeElement($commande)) {
            $commande->removeProduit($this);
        }

        return $this;
    }

    public function isIsEtat(): ?bool
    {
        return $this->isEtat;
    }

    public function setIsEtat(bool $isEtat): self
    {
        $this->isEtat = $isEtat;

        return $this;
    }
}