<?php 
namespace AppBundle\EventListener\Doctrine;

use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;
use AppBundle\Entity\CreatedByUserInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

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
	
	public function preRemove(LifecycleEventArgs $event) {
		$entity = $event->getEntity();
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
	
	/* (non-PHPdoc)
	 * @see \Doctrine\Common\EventSubscriber::getSubscribedEvents()
	 */
	public function getSubscribedEvents() {
		return array(
			'prePersist',
			'preRemove'
		);
	}

}