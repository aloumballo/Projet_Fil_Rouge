<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;
    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }
    public function load(ObjectManager $manager): void
    {
        $user = new User();
        $user->setEmail('client@gmail.com');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user,
            'passer'
        );
        $user->setPassword($hashedPassword);
        $user->setRoles(['ROLE_CLIENT']);
        $user1 = new User();
        $user1->setEmail('gestionnaire@gmail.com');
        $hashedPassword = $this->passwordHasher->hashPassword(
            $user1,
            'passer'
        );

        // $user2 = new User();
        // $user2->setEmail('client2@gmail.com');
        // $hashedPassword = $this->passwordHasher->hashPassword(
        //     $user2,
        //     'passer'
        // );
        // $user2->setPassword($hashedPassword);
        // $user2->setRoles(['ROLE_CLIENT']);


        $user1->setPassword($hashedPassword);
        $user1->setRoles(['ROLE_GESTIONNAIRE']);
        $manager->persist($user);
        $manager->persist($user1);
        // $manager->persist($user2);
        $manager->flush();
    }
}