<?php

namespace App\Entity;

use App\Entity\Produit;
use Doctrine\ORM\Mapping as ORM;
use App\Repository\PortionFriteRepository;
use ApiPlatform\Core\Annotation\ApiResource;

#[ApiResource]


#[ORM\Entity(repositoryClass: PortionFriteRepository::class)]
class PortionFrite extends Produit
{
    // #[ORM\Id]
    // #[ORM\GeneratedValue]
    // #[ORM\Column(type: 'integer')]
    // private $id;

    // public function getId(): ?int
    // {
    //     return $this->id;
    // }
}