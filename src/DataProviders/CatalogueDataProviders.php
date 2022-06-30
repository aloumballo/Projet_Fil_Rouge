<?php
// api/src/DataProvider/BlogPostCollectionDataProvider.php

namespace App\DataProviders;

use App\Entity\Catalogue;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;

use App\Repository\BurgerRepository;
use App\Repository\MenuRepository;

final class  CatalogueDataProviders implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private $menu;
    private $burger;
    public function __construct(MenuRepository $menu, BurgerRepository $burger)
    {
        $this->menu=$menu;
        $this->burger=$burger;
    }
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Catalogue::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        $catalogue = [];
        $catalogue['menu'] = $this->menu->findAll();
        $catalogue['burger'] = $this->burger->findAll();
        return $catalogue;

        // Retrieve the blog post collection from somewhere
        // yield new BlogPost(1);
        // yield new BlogPost(2);
    }
}