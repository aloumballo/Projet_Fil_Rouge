<?php
// src/DataPersister/UserDataPersister.php

namespace App\DataPersister;

use App\Entity\User;
use App\Service\SendEmail;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use App\Entity\Burger;
use App\Entity\Menu;
use App\Entity\Produit;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 *
 */
class ProduitDataPersister implements ContextAwareDataPersisterInterface
{
    private $_entityManager;
    private $tokenStorage;
    private   $prix = 0;

    public function __construct(EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage)
    {
        $this->_entityManager = $entityManager;
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * {@inheritdoc}
     */
    public function supports($data, array $context = []): bool
    {

        return $data instanceof Produit;
    }


    public function persist($data, array $context = [])
    {

        if ($data instanceof Produit) {
           // dd('ok');
            if ($data instanceof Menu) {
              //  dd($data->getMenuBurgers()[0]->getBurger()->getPrix());

                foreach ($data->getMenuBurgers() as $burger) {

                    $this->prix += $burger->getBurger()->getPrix();
                    // dd($this->prix);

                }
                // dd($data->getMenuBurgers()[0]->getBurger()->getPrix());

                foreach ($data->getMenuPortionFrites() as $burgers) {

                    $this->prix += $burgers->getPortionFrite()->getPrix();
                    // dd($prix);

                }
                foreach ($data->getMenuTailles() as $burgers) {

                    $this->prix += $burgers->getTaille()->getPrix();
                    // dd($prix);

                }

                $data->setPrix($this->prix);
                // dd($prix);

                // $data->setPrix($prix);
                //    dd($data->getBurgers())  ;
                // $burgersMenu = $data->getMenuBurgers();
                // // dd(count($burgersMenu));
                // if (count($burgersMenu) == 0) {
                //     dd('burgers forces');
                // }
            }
            //  $image=file_get_contents($data->getImageFile();
            //  $data->setImage($image));
            //   if ($data->getImageFile()) {
            //       $data->setImage(\file_get_contents($data->getImageFile()));
            //   }

        }



         $this->_entityManager->persist($data);
        $this->_entityManager->flush();
        //dd($this->tokenStorage->getToken()->getUser()); 
        $data->setGestionnaire($this->tokenStorage->getToken()->getUser());

        // $data->setGestionnaire($this->token->getUser());

    }

    /**
     * {@inheritdoc}
     */
    public function remove($data, array $context = [])
    {
        $this->_entityManager->remove($data);
        $this->_entityManager->flush();
    }
}