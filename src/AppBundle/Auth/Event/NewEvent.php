<?php 
namespace AppBundle\Auth\Event;

use Symfony\Component\EventDispatcher\Event;
use AppBundle\Auth\Model\UserRegistration;

class NewEvent extends Event {
	const ID = 'app.auth.registration.account.new';
	
	protected $userRegistration;
	
	public function __construct(UserRegistration $userRegistration) {
		$this->userRegistration = $userRegistration;
	}
	
	public function getUserRegistration() {
		return $this->userRegistration;
	}
	
	public function setUserRegistration(UserRegistration $userRegistration) {
		$this->userRegistration = $userRegistration;
		return $this;
	}
}