<?php
namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity
 * @ORM\Table
 * 
 */
class User implements UserInterface, \Serializable
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
    protected $email;
    /**
     * @ORM\Column(type="string")
     */
    protected $password;
    /**
     * @ORM\Column(type="string")
     */
    protected $name;
    /**
     * @ORM\Column(type="date")
     */
    protected $createdAt;
    
    /**
    * 
    * @ORM\OneToMany(targetEntity="\AppBundle\Entity\Task",mappedBy="createdBy")
    *
    */
    protected $createdTasks;    

    /**
     * @ORM\OneToMany(targetEntity="Category", mappedBy="createdBy")
     */
    protected $createdCategories;


    public function __construct() {
        $this->createdAt = new \DateTime("now");
        $this->createdCategories = new ArrayCollection();
        $this->assignedTasks = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set name
     *
     * @param string $name
     * @return User
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string 
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $cratedAt
     * @return User
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
   

    /**
     * Add createdCategories
     *
     * @param \AppBundle\Entity\Category $createdCategories
     * @return User
     */
    public function addCreatedCategory(\AppBundle\Entity\Category $createdCategories)
    {
        $this->createdCategories[] = $createdCategories;

        return $this;
    }

    /**
     * Remove createdCategories
     *
     * @param \AppBundle\Entity\Category $createdCategories
     */
    public function removeCreatedCategory(\AppBundle\Entity\Category $createdCategories)
    {
        $this->createdCategories->removeElement($createdCategories);
    }

    /**
     * Get createdCategories
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getCreatedCategories()
    {
        return $this->createdCategories;
    }

    /**
     * Add assignedTasks
     *
     * @param \AppBundle\Entity\Task $assignedTasks
     * @return User
     */
    public function addAssignedTask(\AppBundle\Entity\Task $assignedTasks)
    {
        $this->assignedTasks[] = $assignedTasks;

        return $this;
    }

    /**
     * Remove assignedTasks
     *
     * @param \AppBundle\Entity\Task $assignedTasks
     */
    public function removeAssignedTask(\AppBundle\Entity\Task $assignedTasks)
    {
        $this->assignedTasks->removeElement($assignedTasks);
    }

    /**
     * Get assignedTasks
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAssignedTasks()
    {
        return $this->assignedTasks;
    }
    
    
    //interface
    /**
     * @inheritdoc
     */
    public function getSalt() {
    	return "";
    }
    
    /**
     * @inheritdoc
     */
    public function getUsername() {
    	return $this->getEmail();
    }
    
    /**
     * @inheritdoc
     */
    public function getRoles() {
    	return array('ROLE_USER');
    }
    
    /**
     * @inheritdoc 
     */
    public function eraseCredentials()
    {
    }
    
    public function serialize() {
    	return serialize(array(
    		'id' => $this->id,
    		'email' => $this->email, 
    		'password' => $this->password,
    		'createdAt' => $this->createdAt
    	));
    }
    
    public function unserialize($serializedData) {
    	$arr = unserialize($serializedData);
    	$this->id = $arr['id'];
    	$this->email = $arr['email'];
    	$this->password = $arr['password'];
    	$this->createdAt = $arr['createdAt'];
    }
}
