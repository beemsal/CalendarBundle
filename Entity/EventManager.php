<?php

namespace Rizza\CalendarBundle\Entity;

use Rizza\CalendarBundle\Model\EventManager;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class EventManager extends BaseEventManager
{

    /**
     * @var EntityManager
     */
    protected $em;

    /**
     * @var EntityRepository
     */
    protected $repo;

    /**
     * @var string
     */
    protected $class;

    public function __construct(EntityManager $em, $class)
    {
        $this->em = $em;
        $this->repo = $em->getRepository($class);
        $this->class = $class;
    }

    function addEvent(EventInterface $event)
    {
        $this->em->persist($event);
        $this->em->flush();

        return true;
    }

    function updateEvent(EventInterface $event)
    {
        $this->em->persist($event);
        $this->em->flush();

        return true;
    }

    function removeEvent(EventInterface $event)
    {
        $this->em->remove($event);
        $this->em->flush();

        return true;
    }
    
    public function find($id)
    {
        $event = $this->repo->find($id);
        if (null === $event) {
            throw new NotFoundHttpException();
        }

        return $event;
    }

    public function getClass()
    {
        return $this->class;
    }

}
