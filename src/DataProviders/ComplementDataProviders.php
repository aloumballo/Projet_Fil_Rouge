<?php
// api/src/DataProvider/BlogPostCollectionDataProvider.php

namespace App\DataProviders;

use App\Entity\Complement;
use App\Repository\PortionFriteRepository;
use ApiPlatform\Core\DataProvider\RestrictedDataProviderInterface;
use ApiPlatform\Core\DataProvider\ContextAwareCollectionDataProviderInterface;
use App\Repository\BoissonRepository;

final class ComplementDataProviders implements ContextAwareCollectionDataProviderInterface, RestrictedDataProviderInterface
{
    private $frits;
    private $boisson;
    public function __construct(PortionFriteRepository $frits, BoissonRepository $boisson)
    {
        $this->frits = $frits;
        $this->boisson = $boisson;
    }
    public function supports(string $resourceClass, string $operationName = null, array $context = []): bool
    {
        return Complement::class === $resourceClass;
    }

    public function getCollection(string $resourceClass, string $operationName = null, array $context = []): iterable
    {
        $complements = [];
        $complements['frits'] = $this->frits->findAll();
        $complements['boisson'] = $this->boisson->findAll();
        return $complements;

        // Retrieve the blog post collection from somewhere
        // yield new BlogPost(1);
        // yield new BlogPost(2);
    }
}