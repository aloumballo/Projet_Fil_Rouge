<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use App\Repository\QuartierRepository;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Annotation\Groups;

#[ApiResource(
    collectionOperations: [
        "get" => [
            'method' => 'get',
            'path' => '/users',
            'status' => Response::HTTP_OK,
            'normalization_context' => ['groups' => ["Quartier"]],

        ],
        "post" => [
            'denormalization_context' => ['groups' => ["Quartier:wr"]],

        ]
    ],

    itemOperations: [
        "put" => [
            // "security" => "is_granted('ROLE_GESTIONNAIRE')",
            // "security" => "Vous n'avez pas access à cette Ressource",
        ],
        "get" => [
            'method' => 'get',
            'status' => Response::HTTP_OK,
            'normalization_context' => ['groups' => ['Quartier:all']],
        ]
    ]
)]

#[ORM\Entity(repositoryClass: QuartierRepository::class)]
class Quartier
{
    #[ORM\Id]
    #[ORM\GeneratedValue]

    #[Groups(["Zone", "Zone:wr", "Quartier", "Quartier:wr"])]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'string', length: 20)]
    #[Groups(["Zone", "Zone:wr", "Quartier", "Quartier:wr"])]
    private $libelle;

    #[ORM\ManyToOne(targetEntity: Zone::class, inversedBy: 'quartiers')]
    private $zone;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getZone(): ?Zone
    {
        return $this->zone;
    }

    public function setZone(?Zone $zone): self
    {
        $this->zone = $zone;

        return $this;
    }
}