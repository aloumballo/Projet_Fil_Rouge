<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\CommandeRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;



#[ORM\Entity(repositoryClass: CommandeRepository::class)]
#[ApiResource(
    collectionOperations: [
        "get" => [
            'method' => 'get',
            'path' => '/commandes',
            'status' => Response::HTTP_OK,
            "normalization_context" => ["groups" => ["Commande:read"]],
        ],
        "post" => [
            'status' => Response::HTTP_OK,
            "denormalization_context" => ["groups" => ["Commande:write"]],

        ]
    ],
    itemOperations: [
        "put" => [],
        "get" => [
            'method' => 'get',
            'status' => Response::HTTP_OK,
        ]
    ]
)]

// #[Assert\Callback([ServiceCommande::class,'valider'])]
//#[Assert\Callback([ServiceCommande::class,'valide'])]

class Commande
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]

    private $id;

    // #[Groups(["Commande:write"])]
    #[ORM\Column(type: 'string', length: 20,nullable:true)]
    private $numero;
    
    // #[Groups(["Commande:write"])]
    #[ORM\Column(type: 'datetime')]
    private $date;


    #[ORM\Column(type: 'integer')]
    private $montant;

    // #[ORM\ManyToMany(targetEntity: Produit::class, inversedBy: 'commandes')]
    // private $produits;

    #[ORM\ManyToOne(targetEntity: Zone::class, inversedBy: 'commandes')]
    private $zone;

    #[ORM\ManyToOne(targetEntity: Gestionnaire::class, inversedBy: 'commandes')]
    private $gestionnaire;

    #[ORM\ManyToOne(targetEntity: Livraison::class, inversedBy: 'commandes')]
    private $livraison;

    // #[ORM\OneToMany(mappedBy: 'commande', targetEntity: ProduitCommande::class)]
    // private $produitCommandes;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'commandes')]
    private $client;

    #[Assert\Valid]
    #[Groups(["Commande:write"])]
    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: CommandeBurger::class)]
    private $commandeBurgers;

    #[Assert\Valid]
    #[Groups(["Commande:write"])]
    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: CommandeMenu::class)]
    private $commandeMenus;

    #[Assert\Valid]
    #[Groups(["Commande:write"])]
    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: CommandePortionFrite::class)]
    private $commandePortionFrites;

    #[Assert\Valid]
    #[Groups(["Commande:read", "Commande:write"])]
    #[ORM\OneToMany(mappedBy: 'commande', targetEntity: CommandeTailleBoisson::class)]
    private $commandeTailleBoissons;

    // #[Assert\Valid]
    // #[Groups(["Commande:write"])]
    // #[ORM\ManyToOne(targetEntity: CommandeBurger::class, inversedBy:'commandes', cascade: ["persist"])]
    // private $commandeBurger;

    // #[Assert\Valid]
    // #[Groups(["Commande:write"])]
    // #[ORM\ManyToOne(targetEntity: CommandePortionFrite::class, inversedBy:'commandes', cascade: ["persist"])]
    // private $commandePortionFrite;
    
    // #[Assert\Valid]
    // // #[Groups(["Commande:read", "Commande:write"])]
    // #[ORM\ManyToOne(targetEntity: CommandeTailleBoisson::class, inversedBy:'commandes', cascade: ["persist"])]
    // private $commandeTailleBoisson;

    
    // #[Assert\Valid]
    // #[Assert\Count(
    //     min: 1,
    //     //max: 5,
    //     minMessage: 'Au moins un burger !!!'
    // )]
    // #[Groups(["Commande:write"])]
    // #[ORM\ManyToOne(targetEntity: CommandeMenu::class, inversedBy:'commandes', cascade: ["persist"])]
    // private $commandeMenu;

    // #[ORM\OneToMany(mappedBy: 'commande', targetEntity: Menu::class)]
    // private $menus;

    public function __construct()
    {
        // $this->produits = new ArrayCollection();
       // $this->produitCommandes = new ArrayCollection();
       //$this->menus = new ArrayCollection();
       $this->commandeBurgers = new ArrayCollection();
       $this->commandeMenus = new ArrayCollection();
       $this->commandePortionFrites = new ArrayCollection();
       $this->commandeTailleBoissons = new ArrayCollection();
       $this->date = new \DateTime();
       $this->numero="NUM".date('ymdhis');
       
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNumero(): ?string
    {
        return $this->numero;
    }

    public function setNumero(string $numero): self
    {
        $this->numero = $numero;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    // /**
    //  * @return Collection<int, Produit>
    //  */
    // public function getProduits(): Collection
    // {
    //     return $this->produits;
    // }

    // public function addProduit(Produit $produit): self
    // {
    //     if (!$this->produits->contains($produit)) {
    //         $this->produits[] = $produit;
    //     }

    //     return $this;
    // }

    // public function removeProduit(Produit $produit): self
    // {
    //     $this->produits->removeElement($produit);

    //     return $this;
    // }


    public function getZone(): ?Zone
    {
        return $this->zone;
    }

    public function setZone(?Zone $zone): self
    {
        $this->zone = $zone;

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

    public function getLivraison(): ?Livraison
    {
        return $this->livraison;
    }

    public function setLivraison(?Livraison $livraison): self
    {
        $this->livraison = $livraison;

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
    //         $produitCommande->setCommande($this);
    //     }

    //     return $this;
    // }

    // public function removeProduitCommande(ProduitCommande $produitCommande): self
    // {
    //     if ($this->produitCommandes->removeElement($produitCommande)) {
    //         // set the owning side to null (unless already changed)
    //         if ($produitCommande->getCommande() === $this) {
    //             $produitCommande->setCommande(null);
    //         }
    //     }

    //     return $this;
    // }

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): self
    {
        $this->client = $client;

        return $this;
    }

    // public function getCommandeBurger(): ?CommandeBurger
    // {
    //     return $this->commandeBurger;
    // }

    // public function setCommandeBurger(?CommandeBurger $commandeBurger): self
    // {
    //     $this->commandeBurger = $commandeBurger;

    //     return $this;
    // }

    // public function getCommandePortionFrite(): ?CommandePortionFrite
    // {
    //     return $this->commandePortionFrite;
    // }

    // public function setCommandePortionFrite(?CommandePortionFrite $commandePortionFrite): self
    // {
    //     $this->commandePortionFrite = $commandePortionFrite;

    //     return $this;
    // }

    // public function getCommandeTailleBoisson(): ?CommandeTailleBoisson
    // {
    //     return $this->commandeTailleBoisson;
    // }

    // public function setCommandeTailleBoisson(?CommandeTailleBoisson $commandeTailleBoisson): self
    // {
    //     $this->commandeTailleBoisson = $commandeTailleBoisson;

    //     return $this;
    // }

    // public function getCommandes(): ?string
    // {
    //     return $this->commandes;
    // }

    // public function setCommandes(string $commandes): self
    // {
    //     $this->commandes = $commandes;

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
    //         $menu->setCommande($this);
    //     }

    //     return $this;
    // }

    // public function removeMenu(Menu $menu): self
    // {
    //     if ($this->menus->removeElement($menu)) {
    //         // set the owning side to null (unless already changed)
    //         if ($menu->getCommande() === $this) {
    //             $menu->setCommande(null);
    //         }
    //     }

    //     return $this;
    // }

    // #[Assert\Callback]
    // public function validate(ExecutionContextInterface $context, $payload)
    // {

    //     if (count($this->getCommandeBurger()) == 0 && count($this->getCommandeTailleBoisson()) == 0 && count($this->getCommandeMenu()) == 0) {
    //         $context->buildViolation('saisir au moins un complement')
    //         ->addViolation();
    //     }
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
            $commandeBurger->setCommande($this);
        }

        return $this;
    }

    public function removeCommandeBurger(CommandeBurger $commandeBurger): self
    {
        if ($this->commandeBurgers->removeElement($commandeBurger)) {
            // set the owning side to null (unless already changed)
            if ($commandeBurger->getCommande() === $this) {
                $commandeBurger->setCommande(null);
            }
        }

        return $this;
    }

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
            $commandeMenu->setCommande($this);
        }

        return $this;
    }

    public function removeCommandeMenu(CommandeMenu $commandeMenu): self
    {
        if ($this->commandeMenus->removeElement($commandeMenu)) {
            // set the owning side to null (unless already changed)
            if ($commandeMenu->getCommande() === $this) {
                $commandeMenu->setCommande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CommandePortionFrite>
     */
    public function getCommandePortionFrites(): Collection
    {
        return $this->commandePortionFrites;
    }

    public function addCommandePortionFrite(CommandePortionFrite $commandePortionFrite): self
    {
        if (!$this->commandePortionFrites->contains($commandePortionFrite)) {
            $this->commandePortionFrites[] = $commandePortionFrite;
            $commandePortionFrite->setCommande($this);
        }

        return $this;
    }

    public function removeCommandePortionFrite(CommandePortionFrite $commandePortionFrite): self
    {
        if ($this->commandePortionFrites->removeElement($commandePortionFrite)) {
            // set the owning side to null (unless already changed)
            if ($commandePortionFrite->getCommande() === $this) {
                $commandePortionFrite->setCommande(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, CommandeTailleBoisson>
     */
    public function getCommandeTailleBoissons(): Collection
    {
        return $this->commandeTailleBoissons;
    }

    public function addCommandeTailleBoisson(CommandeTailleBoisson $commandeTailleBoisson): self
    {
        if (!$this->commandeTailleBoissons->contains($commandeTailleBoisson)) {
            $this->commandeTailleBoissons[] = $commandeTailleBoisson;
            $commandeTailleBoisson->setCommande($this);
        }

        return $this;
    }

    public function removeCommandeTailleBoisson(CommandeTailleBoisson $commandeTailleBoisson): self
    {
        if ($this->commandeTailleBoissons->removeElement($commandeTailleBoisson)) {
            // set the owning side to null (unless already changed)
            if ($commandeTailleBoisson->getCommande() === $this) {
                $commandeTailleBoisson->setCommande(null);
            }
        }

        return $this;
    }
}