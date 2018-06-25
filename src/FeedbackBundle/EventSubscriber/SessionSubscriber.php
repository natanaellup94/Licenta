<?php

namespace FeedbackBundle\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use FeedbackBundle\Entity\Session;

class SessionSubscriber implements EventSubscriber
{
    /**
     * Returns an array of events this subscriber wants to listen to.
     *
     * @return array
     */
    public function getSubscribedEvents()
    {
        return array('prePersist');
    }

    /**
     * @param LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $object = $args->getObject();

        if(!$object instanceof Session){
            return;
        }

        $object->setStatus(Session::NEW_STATUS);
        $object->setAdded(new \DateTime());
    }
}