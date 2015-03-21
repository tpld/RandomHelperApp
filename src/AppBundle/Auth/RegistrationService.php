<?php
namespace AppBundle\Auth;

use AppBundle\Entity\User;
use Doctrine\ORM\EntityManager;
use AppBundle\Auth\Event\NewEvent;
use AppBundle\Auth\Event\AppBundle\Auth\Event;
use AppBundle\Auth\Model\UserRegistration;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

class RegistrationService {
	protected $entityManager;
	protected $eventDispatcher;
	
	public function __construct(EntityManagerInterface $entityManager, EventDispatcherInterface $eventDispatcher) {
		$this->entityManager = $entityManager;
		$this->eventDispatcher = $eventDispatcher;
	}
	
	public function create(UserRegistration $userRegistration) {
		$event = new NewEvent($userRegistration);
		$this->eventDispatcher->dispatch(NewEvent::ID, $event);
    	$this->entityManager->persist($userRegistration->getUser());
    	$this->entityManager->flush();
	}
	
}