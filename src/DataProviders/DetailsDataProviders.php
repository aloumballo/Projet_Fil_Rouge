<?php

namespace App\DataProviders;





use App\Entity\Boisson;

use App\Entity\Dto\Details;
use App\Repository\MenuRepository;
use App\Repository\BurgerRepository;
use App\Repository\BoissonRepository;
use App\Repository\ComplementRepository;
use App\Repository\PortionFriteRepository;
use App\Repository\TailleBoissonRepository;
use ApiPlatform\Core\DataProvider\ItemDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;

class DetailsDataProviders implements ItemDataProviderInterface, RestrictedDataProviderInterface
{
    private $burgers;
    private $menu;
    private $taille;
    private $portion;

    public function __construct(BurgerRepository $burger, MenuRepository $menu, TailleBoissonRepository $taille, PortionFriteRepository $portion)
    {
        $this->burgers = $burger;
        $this->taille = $taille;
        $this->menu = $menu;
        $this->portion = $portion;
    }
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Details::class === $resourceClass;
    }

    public function getItem(string $resourceClass, $id, string $operationName = null, array $context = []): ?Details
    {
        $detailsProduit = new Details();
        $detailsProduit->id = $id;
        $detailsProduit->burger = $this->burgers->find($id);
        $detailsProduit->menu = $this->menu->find($id);
        $detailsProduit->taille = $this->taille->findAll(['isEtat' => true]);
        $detailsProduit->portion = $this->portion->findAll(['isEtat' => true]);


        return $detailsProduit;
    }
}