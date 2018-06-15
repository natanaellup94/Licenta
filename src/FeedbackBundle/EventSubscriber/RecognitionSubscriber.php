<?php
/**
 * Created by PhpStorm.
 * User: Nati
 * Date: 6/15/2018
 * Time: 4:50 PM
 */

namespace FeedbackBundle\EventSubscriber;

use Doctrine\Common\EventSubscriber;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use FeedbackBundle\Entity\Recognition;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class RecognitionSubscriber implements EventSubscriber
{
    /**
     * @var TokenStorage
     */
    private $tokenStorage;

    /**
     * RecognitionSubscriber constructor.
     * @param TokenStorage $tokenStorage
     */
    public function __construct(TokenStorage $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

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

        if(!$object instanceof Recognition){
            return;
        }
        $currentUser = $this->tokenStorage->getToken()->getUser();

        $object->setAdded(new \DateTime());
        $object->setFrom($currentUser);
    }
}