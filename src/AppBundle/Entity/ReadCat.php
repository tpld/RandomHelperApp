<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ReadCat
 *
 * @ORM\Entity
 * @ORM\Table()
 */
class ReadCat 
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
     * @ORM\Column(name="readName", type="text")
     */
    protected $readName;
    
    
    public function getId()
    {
    	return $this->id;
    }
    
    public function setReadName($readName)
    {
    	$this->readName = $readName;
    	return $this;
    }
    
    public function getReadName()
    {
    	return $this->readName;
    }
    
    
}
