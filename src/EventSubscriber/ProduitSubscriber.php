<?php

namespace App\EventSubscriber;

use App\Entity\Burger;
use App\Entity\Menu;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;



class ProduitSubscriber implements EventSubscriberInterface
{
    private ?TokenInterface $token;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->token = $tokenStorage->getToken();
       
    }

    public static function getSubscribedEvents(): array
    {
       
        return [Events::prePersist];
        
    }
    public function getUser()
    {
        if (null === $token = $this->token) {
            return null;
        }
        if (!is_object($user = $token->getUser())) {
            // e.g. anonymous authentication
            return null;
        }
        
        //dd($user);
        
        return $user;
    }
    public function prePersist(LifecycleEventArgs $args)
    {
       // dd($args->getObject());
    

       
       // dd($args->getObject());//Objet à inserer
        
        if ($args->getObject() instanceof Menu) {
            
            
            $args->getObject()->setGestionnaire($this->getUser());
         //   dd($args->getObject()->setGestionnaire($this->getUser()));

            //$args->getObject()->setUser($this->getUser());
        }
        /*  if ($args->getObject() instanceof Burger) {

            $args->getObject()->setGestionnaire($this->getUser());
            
            $args->getObject()->setUser($this->getUser());
        } */

    }
}