<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Read
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\CategoryRepository")
 */
class Read
{
    /**
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     *
     * @ORM\Column(name="readDate", type="datetime")
     */
    protected $readDate;
    
     /**
     *
     * @ORM\Column(name="readVal", type="decimal", scale="2")
     */
    protected $readVal;
    
     /**
     *
     * @ORM\Column(name="userId", type="integer")
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="userId", referencedColumnName="id")
     */
    protected $userId;   
 
    
     /**
     * Get id
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set readDate
     * @return Read
     */
    public function setReadDate($readDate)
    {
        $this->readDate = $readDate;
        return $this; //to jest po to, by móc robić $obiekt->setReadDate()->setName()->setCosTam();
    }
    
        public function getReadDate()
    {
        return $this->readDate;
    }
    
    /**
    * set readVal
    * @return Read
    */
    public function setReadVal($readVal) 
    {
    	$this->readVal = $readVal;
    	return $this;
    }
    
        /**
    * set readVal
    * @return Read
    */
    public function getReadVal($readVal) 
    {
    	return $this->readVal;
    }
    
}
