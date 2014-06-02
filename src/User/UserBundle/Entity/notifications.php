<?php
// src/User/UserBundle/Entity/notifications.php

namespace User\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use User\UserBundle\Entity\user;

/**
 * @ORM\Entity
 */
class notifications
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

	/**
	 * @var integer 
	 *
	 * @ORM\ManyToOne(targetEntity="User\UserBundle\Entity\user")
	 */
	private $user_to;
	
		/**
	 * @var integer 
	 *
	 * @ORM\ManyToOne(targetEntity="User\UserBundle\Entity\user")
	 */
	private $user_from;
	
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datetime", type="datetime")
     */
    private $datetime;

    /**
     * @var integer
	 *@ORM\Column(name="type", type="integer")
     */
    private $type;
	
	//Constructor
	 public function __construct()
	 {
		$this->datetime = new \Datetime();
		$this->user_from = new \Doctrine\Common\Collections\ArrayCollection();
		$this->user_to = new \Doctrine\Common\Collections\ArrayCollection();
	 }
	 
	/**
     * Set user_to
     *
     * @param user $user_to
     * @return user
     */
      public function setUser_to(\User\UserBundle\Entity\user $user_to)
    {
        $this->user_to = $user_to;

        return $this;
    }
	
    /**
     * Get user_to
     *
     * @return user
     */
    public function getUser_to()
    {
        return $this->user_to;
    }
	
		/**
     * Set user_from
     *
     * @param user $user_from
     * @return user
     */
      public function setUser_from(\User\UserBundle\Entity\user $user_from)
    {
        $this->user_from = $user_from;

        return $this;
    }
	
    /**
     * Get user_from
     *
     * @return user
     */
    public function getUser_from()
    {
        return $this->user_from;
    }
	
		/**
     * Set type
     *
     * @param integer $type
     * @return user
     */
      public function setType($type)
    {
        $this->type = $type;

        return $this;
    }
	
    /**
     * Get type
     *
     * @return user
     */
    public function getType()
    {
        return $this->type;
    }
}
?>