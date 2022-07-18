<?php

namespace App\Entity;

use DateTime;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\UserRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Serializer\Annotation\SerializedName;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;

// #[ApiResource(
//     normalizationContext: ["groups" => ["user:read"]],
//     denormalizationContext: ["groups" => ["user:write"]]
// )]

#[ORM\InheritanceType("JOINED")]
#[ORM\DiscriminatorColumn(name: "type", type: "string")]
#[ORM\DiscriminatorMap(["user" => User::class, "livreur" => Livreur::class, "gestionnaire" => Gestionnaire::class, "client" => Client::class])]
#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ApiResource(
    collectionOperations: [
        "get" => [
            'method' => 'get',
            'path' => '/users',
            'status' => Response::HTTP_OK,
            'normalization_context' => ['groups' => ["User:read:simple"]],

        ],
        "post" => [
            'denormalization_context' => ['groups' => ["User:write"]],

        ]
    ],

    itemOperations: [
        "put" => [
            "security" => "is_granted('ROLE_GESTIONNAIRE')",
            "security" => "Vous n'avez pas access à cette Ressource",
        ],
        "get" => [
            'method' => 'get',
            'status' => Response::HTTP_OK,
            'normalization_context' => ['groups' => ['User:read:all']],
        ]
    ]
)]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    #[Groups(['User:read:simple', 'Burger:read:all', 'write', "Burger:read:simple", 'Produitt'])]
    protected $id;
    #[ORM\Column(type: 'string', length: 180, unique: true)]
    #[Groups(['User:read:simple', 'User:write:simple', 'Burger:read:all', "Burger:read:simple"])]
    protected $email;
    #[ORM\Column(type: 'json')]
    #[Groups(['User:read:simple', 'User:write:simple'])]
    protected $roles = [];

    #[ORM\Column(type: 'string')]
    protected $password;

    #[ORM\Column(type: 'string', length: 20)]
    #[Groups(['User:read:simple', 'User:write:simple', "Burger:read:simple"])]
    private $nom = "alou";

    #[ORM\Column(type: 'string', length: 20)]
    #[Groups(['User:read:simple', 'User:write:simple', "Burger:read:simple"])]
    private $prenom = "mballo";

    #[ORM\Column(type: 'string', length: 40, nullable: true)]
    #[Groups(['User:read:simple', 'User:write:simple', "Burger:read:simple"])]
    private $adresse = "guediawaye";

    #[ORM\Column(type: 'string', length: 20, nullable: true)]
    #[Groups(['User:read:simple', 'User:write:simple', "Burger:read:simple"])]
    private $telephone = "774154533";

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isEtat;

    #[ORM\Column(type: 'boolean', nullable: true)]
    private $isEnable;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $token;

    #[ORM\Column(type: 'datetime', nullable: true)]
    private $expireAT;

    // #[ORM\Column(type: 'string', length: 255)]
    #[SerializedName("password")]
    private $PleinPassword;




    public function __construct()
    {
        $this->isEnable = "false";
        $this->generateToken();
    }
    public function generateToken()
    {
        $this->expireAT = new \DateTime("+1 day");
        $this->token = rtrim(str_replace(['+', '/', '='], ['-', '_', ''], base64_encode(random_bytes(128))));
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): self
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_VISITEUR';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
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

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): self
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getAdresse(): ?string
    {
        return $this->adresse;
    }

    public function setAdresse(string $adresse): self
    {
        $this->adresse = $adresse;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(string $telephone): self
    {
        $this->telephone = $telephone;

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

    public function isIsEnable(): ?bool
    {
        return $this->isEnable;
    }

    public function setIsEnable(bool $isEnable): self
    {
        $this->isEnable = $isEnable;

        return $this;
    }

    public function getToken(): ?string
    {
        return $this->token;
    }

    public function setToken(string $token): self
    {
        $this->token = $token;

        return $this;
    }

    public function getExpireAT(): ?\DateTimeInterface
    {
        return $this->expireAT;
    }

    public function setExpireAT(\DateTimeInterface $expireAT): self
    {
        $this->expireAT = $expireAT;

        return $this;
    }

    public function getPleinPassword(): ?string
    {
        return $this->PleinPassword;
    }

    public function setPleinPassword(string $PleinPassword): self
    {
        $this->PleinPassword = $PleinPassword;

        return $this;
    }
}