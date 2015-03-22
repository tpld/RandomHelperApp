<?php 
namespace AppBundle\Entity;

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