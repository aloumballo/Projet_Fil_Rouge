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
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Serializer\Annotation\SerializedName;

#[ApiResource(
    collectionOperations: [
        "get" => [
            'method' => 'get',
            'path' => '/produits',
            'status' => Response::HTTP_OK,
            'normalization_context' => ['groups' => ["Produit"]],

        ],
        "post" => [
            "security" => "is_granted('ROLE_GESTIONNAIRE')",

            "security_message" => "Vous n'avez pas access à cette Ressource",
            'denormalization_context' => ['groups' => ['Produitt']],

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
            'normalization_context' => ['groups' => ['Produit:all']],
        ]
    ]
)]

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
    #[Groups(['Burger:read:simple', 'Burger:read:all', 'write', 's:write', "Commande:write"])]
    protected $id;

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    #[Groups(['Burger:read:simple', 'write', 'Burger:read:all', 's:write', 'Produitt'])]
    protected $nom;

    // #[ORM\Column(type: 'string', length: 20, nullable: true)]
    // // #[Groups(['Burger:read:simple', 'Burger:write:simple', 'Burger:read:all','s:write'])]
    // protected $image;

    #[ORM\Column(type: 'integer', nullable: true)]
    #[Groups(['Burger:read:simple','Burger:read:all', 's:write', 'Produitt'])]
    protected $prix;

    // #[ORM\ManyToMany(targetEntity: Commande::class, mappedBy: 'produits')]
    // private $commandes;

    #[ORM\Column(type: 'boolean')]
    #[Groups(['Burger:read:simple', 'Produitt'])]
    protected $isEtat = true;

    #[Groups(['Produit', 'Produitt', 'Produit:simple'])]
    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'produits')]
    private $gestionnaire;

    //#[Groups(['Burger:read:simple', 'write', 'Burger:read:all', 's:write', 'Produitt'])]
    #[ORM\Column(type: 'blob', nullable: true)]
    private $image;

    // #[ORM\Column(type: 'string', length: 20, nullable: true)]
    // #[Groups(['Burger:read:simple', 'write', 'Burger:read:all', 's:write', 'Produitt'])]

    #[Groups(['Produitt', 'write'])]
    #[SerializedName("image")]
    private $imageFile;


    // #[ORM\OneToMany(mappedBy: 'produit', targetEntity: ProduitCommande::class)]
    // private $produitCommandes;

    public function __construct()
    {
        $this->commandes = new ArrayCollection();
        // $this->produitCommandes = new ArrayCollection();
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

    // public function getImage(): ?string
    // {
    //     return $this->image;
    // }

    // public function setImage(string $image): self
    // {
    //     $this->image = $image;

    //     return $this;
    // }

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
    // public function getCommandes(): Collection
    // {
    //     return $this->commandes;
    // }

    // public function addCommande(Commande $commande): self
    // {
    //     if (!$this->commandes->contains($commande)) {
    //         $this->commandes[] = $commande;
    //         $commande->addProduit($this);
    //     }

    //     return $this;
    // }

    // public function removeCommande(Commande $commande): self
    // {
    //     if ($this->commandes->removeElement($commande)) {
    //         $commande->removeProduit($this);
    //     }

    //     return $this;
    // }

    public function isIsEtat(): ?bool
    {
        return $this->isEtat;
    }

    public function setIsEtat(bool $isEtat): self
    {
        $this->isEtat = $isEtat;

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

    // /**
    //  * @return Collection<int, ProduitCommande>
    //  */
    // public function getProduitCommandes(): Collection
    // {
    //     return $this->produitCommandes;
    // }

    // public function addProduitCommande(ProduitCommande $produitCommande): self
    // {
    //     if (!$this->produitCommandes->contains($produitCommande)) {
    //         $this->produitCommandes[] = $produitCommande;
    //         $produitCommande->setProduit($this);
    //     }

    //     return $this;
    // }

    // public function removeProduitCommande(ProduitCommande $produitCommande): self
    // {
    //     if ($this->produitCommandes->removeElement($produitCommande)) {
    //         // set the owning side to null (unless already changed)
    //         if ($produitCommande->getProduit() === $this) {
    //             $produitCommande->setProduit(null);
    //         }
    //     }

    //     return $this;
    // }

    public function getImage()
    {
        return  is_resource($this->image) ? utf8_encode(base64_encode(stream_get_contents($this->image))) : $this->image;
        return $this->image;
        // return (base64_encode(($this->image)));
    }

    public function setImage($image): self
    {
        $this->image = $image;

        return $this;
    }

    public function getImageFile()
    {
        return $this->imageFile;
    }

    public function setImageFile(?string $imageFile): self
    {
        $this->imageFile = $imageFile;

        return $this;
    }
}