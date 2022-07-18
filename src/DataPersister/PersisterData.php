<?php
// src/DataPersister/UserDataPersister.php

namespace App\DataPersister;

use App\Entity\Menu;
use App\Entity\User;
use App\Entity\Burger;
use App\Entity\Produit;
use App\Service\SendEmail;
use Doctrine\ORM\EntityManagerInterface;
use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 *
 */
class PersisterData implements ContextAwareDataPersisterInterface
{
    private $_entityManager;
    private $_passwordEncoder;

    public function __construct(
        EntityManagerInterface $entityManager,
        UserPasswordHasherInterface $passwordEncoder,
        SendEmail $send
    ) {
        $this->_entityManager = $entityManager;
        $this->_passwordEncoder = $passwordEncoder;
        $this->send = $send;
    }

    /**
     * {@inheritdoc}
     */
    public function supports($data, array $context = []): bool
    {
        return $data instanceof User or $data instanceof Produit;
    }

    /**
     * @param User $data
     */
    public function persist($data, array $context = [])
    {

       // dd($data);
        if ($data instanceof User) {
            if ($data->getPleinPassword()) {
                $data->setPassword(
                    $this->_passwordEncoder->hashPassword(
                        $data,
                        $data->getPleinPassword()
                    )
                );
                $data->eraseCredentials();
            }
            $this->send->email($data);
        }

        if ($data instanceof Produit or $data instanceof Menu) {


            $data->setImage(\file_get_contents($data->getImageFile()));
        }


        $this->_entityManager->persist($data);
        $this->_entityManager->flush();
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