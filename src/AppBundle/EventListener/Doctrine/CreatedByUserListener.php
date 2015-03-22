<?php 
namespace AppBundle\EventListener\Doctrine;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Interfaces\Entity;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use AppBundle\Interfaces\Entity\CreatedByUserInterface;

class CreatedByUserListener implements EventSubscriber {
	
	protected $securityTokenStorage;
	
	public function __construct(TokenStorageInterface $securityTokenStorage) {
		
		$this->securityTokenStorage = $securityTokenStorage;
		
	}
	
	public function prePersist(LifecycleEventArgs $event) {
		$entity = $event->getEntity();
		if($entity instanceof CreatedByUserInterface)
		{
			/*@var $token \Symfony\Component\Security\Core\Authentication\Token\TokenInterface */
			$token = $this->securityTokenStorage->getToken();
			if($token->isAuthenticated())
			{
				if($entity->getCreatedBy() === null)
				{
					$entity->setCreatedBy($token->getUser());
				}
			}
		}
	}
	
	protected function checkOwnership($entity) {
		if($entity instanceof CreatedByUserInterface)
		{
			/*@var $token \Symfony\Component\Security\Core\Authentication\Token\TokenInterface */
			$token = $this->securityTokenStorage->getToken();

			if(!$token->isAuthenticated() || $token->getUser() != $entity->getCreatedBy())
			{
				throw new AccessDeniedException();
			}
		}
	}
	
	public function preRemove(LifecycleEventArgs $event) {
		$this->checkOwnership($event->getEntity());
	}
	
	public function postLoad(LifecycleEventArgs $event) {
		$this->checkOwnership($event->getEntity());
	}
	
	/* (non-PHPdoc)
	 * @see \Doctrine\Common\EventSubscriber::getSubscribedEvents()
	 */
	public function getSubscribedEvents() {
		return array(
			'prePersist',
			'preRemove',
			'postLoad'
		);
	}

}