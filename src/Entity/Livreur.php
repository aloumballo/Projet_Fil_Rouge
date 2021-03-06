<?php

namespace App\Entity;

use App\Entity\Gestionnaire;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\LivreurRepository;
use Doctrine\Common\Collections\Collection;
use ApiPlatform\Core\Annotation\ApiResource;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\ArrayCollection;

#[ApiResource(
    collectionOperations: [
        "get" => [
            'method' => 'get',
            'path' => '/livreurs',
            'status' => Response::HTTP_OK,
    "normalizationContext"=> ["groups" => ["Livreur:read"]],
     ],
        "post" => [
    "denormalizationContext"=> ["groups" => ["Livreur:write"]],
    
        ]
    ],
    itemOperations: [ 
        "put" => [
            
        ],
        "get" => [
            'method' => 'get',
            'status' => Response::HTTP_OK,
           
        ]
        
    ]

)]

#[ORM\Entity(repositoryClass: LivreurRepository::class)]
class Livreur extends User
{
    // #[ORM\Id]
    // #[ORM\GeneratedValue]
    // #[ORM\Column(type: 'integer')]
    // private $id;

    #[ORM\Column(type: 'integer')]
    private $matriculeMoto;

   

    #[ORM\OneToMany(mappedBy: 'livreur', targetEntity: Livraison::class)]
    private $livraisons;

    public function __construct()
    {
        $this->livraisons = new ArrayCollection();
    }

    // public function getId(): ?int
    // {
    //     return $this->id;
    // }

    public function getMatriculeMoto(): ?int
    {
        return $this->matriculeMoto;
    }

    public function setMatriculeMoto(int $matriculeMoto): self
    {
        $this->matriculeMoto = $matriculeMoto;

        return $this;
    }

   

    /**
     * @return Collection<int, Livraison>
     */
    public function getLivraisons(): Collection
    {
        return $this->livraisons;
    }

    public function addLivraison(Livraison $livraison): self
    {
        if (!$this->livraisons->contains($livraison)) {
            $this->livraisons[] = $livraison;
            $livraison->setLivreur($this);
        }

        return $this;
    }

    public function removeLivraison(Livraison $livraison): self
    {
        if ($this->livraisons->removeElement($livraison)) {
            // set the owning side to null (unless already changed)
            if ($livraison->getLivreur() === $this) {
                $livraison->setLivreur(null);
            }
        }

        return $this;
    }

    
}