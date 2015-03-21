<?php
namespace AppBundle\Auth\Model;

use AppBundle\Entity\User;

class UserRegistration {
	protected $user;
	
	public function getUser() {
		return $this->user;
	}
	
	public function setUser($user) {
		$this->user = $user;
		return $this;
	}
}