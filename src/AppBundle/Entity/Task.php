<?php
// src/AppBundle/Entity/Task.php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="task")
 */
class Task implements CreatedByUserInterface
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
    * @ORM\JoinColumn(nullable=false)
    */
    protected $createdBy;  

    /**
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\User", inversedBy="assignedTasks")
     * @ORM\JoinColumn(nullable=false)
     * @var AppBundle\Entity\User
     */
    protected $assignee;  
    
    /**
     * @ORM\ManyToOne(targetEntity="\AppBundle\Entity\Category")
     * @ORM\JoinColumn(nullable=false)
     * @var AppBundle\Entity\Category
     */
    protected $category;
    
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
		$this->createdAt = new \DateTime("now");
	}
	


    /**
     * Set assignee
     *
     * @param \AppBundle\Entity\User $assignee
     * @return Task
     */
    public function setAssignee(\AppBundle\Entity\User $assignee = null)
    {
        $this->assignee = $assignee;
	}

    /**
     * Set createdBy
     *
     * @param \AppBundle\Entity\User $createdBy
     * @return Task
     */
    public function setCreatedBy(\AppBundle\Entity\User $createdBy)
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * Get createdBy
     *
     * @return \AppBundle\Entity\User 
     */
    public function getCreatedBy()
    {
        return $this->createdBy;
    }

    /**
     * Get assignee
     *
     * @return \AppBundle\Entity\User 
     */
    public function getAssignee()
    {
        return $this->assignee;
    }

    /**
     * Set category
     *
     * @param \AppBundle\Entity\Category $category
     * @return Task
     */
    public function setCategory(\AppBundle\Entity\Category $category)
    {
        $this->category = $category;

        return $this;
    }

    /**
     * Get category
     *
     * @return \AppBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
}
