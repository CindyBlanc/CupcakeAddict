<?php

namespace App\Controller\Subscribers;

use App\Entity\Cupcake;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;

class CupcakeSubscriber implements EventSubscriberInterface {
    
    private $security;

    public function __construct(Security $security) {
        $this->security = $security;

    }
    public static function getSubscribedEvents() {

        return [
            BeforeEntityPersistedEvent::class =>['setUser']
        ];
    }

    public function setUser(BeforeEntityPersistedEvent$event) {

        $entity = $event->getEntityInstance();
        if($entity instanceof Cupcake) {
            $entity->setAuteur($this->security->getUser());
        }
    }

}