<?php
// src/AppBundle/Entity/Task.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="task")
 */
class Task
{
    /**
     * @ORM\Column(type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
	
    /**
     * @ORM\Column(type="string")
     */
    protected $content;

    /**
     * @ORM\Column(type="date")
     */
    protected $dueDate;

    /**
     * @ORM\Column(type="boolean")
     */
    protected $done;
    
     /**
     * @ORM\Column(type="integer")
     */
    protected $priority;
    
     /**
     * @ORM\Column(type="datetime")
     */
    protected $createdAt;
    
    /**
    * 
    * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\User",inversedBy="createdTasks")
    *
    */
    protected $createdBy;    
    
    
    public function getId() {
    	return $this->id;
	}
	
	public function setContent($content) {
    	$this->content = $content;
	}
	
	public function getContent() {
    	return $this->content;
	}
	
	public function setDueDate($dueDate) {
    	$this->dueDate = $dueDate;
	}
	
	public function getDueDate() {
    	return $this->dueDate;
	}
	
	public function setDone($done) {
    	$this->done = $done;
	}
	
	public function getDone() {
    	return $this->done;
	}
	
	public function setPriority($priority) {
    	$this->priority = $priority;
	}
	
	public function getPriority() {
    	return $this->priority;
	}
	
	public function setCreatedAt($createdAt) {
    	$this->createdAt = $createdAt;
	}
	
	public function getCreatedAt() {
    	return $this->createdAt;
	}
	
	public function __construct() {
		$this->createdAt = new DateTime("now");
	}
	
}


