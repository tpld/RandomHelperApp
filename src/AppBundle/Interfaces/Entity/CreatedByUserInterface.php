<?php 
namespace AppBundle\Interfaces\Entity;

use AppBundle\Entity\User;
interface CreatedByUserInterface {
	/**
	 * @return \AppBundle\Entity\User
	 */
	public function getCreatedBy();
	
	/**
	 * @param User $owner
	 */
	public function setCreatedBy(User $owner);
}