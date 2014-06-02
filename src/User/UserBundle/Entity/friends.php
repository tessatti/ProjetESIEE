<?php
// src/User/UserBundle/Entity/friends.php

namespace User\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use User\UserBundle\Entity\user;

/**
 * @ORM\Entity
 */
class friends
{
  /**
   * @ORM\Id
   * @ORM\ManyToOne(targetEntity="User\UserBundle\Entity\user")
   */
  private $user1;

  /**
   * @ORM\Id
   * @ORM\ManyToOne(targetEntity="User\UserBundle\Entity\user")
   */
  private $user2;

  /**
   * @ORM\Column()
   */
  private $status;
  
  //Constructor
    public function __construct()
  {
    $this->status = 1;
  }
  
    /**
     * Set user1
     *
     * @param user $user1
     * @return user
     */
      public function setUser1(\User\UserBundle\Entity\user $user1)
    {
        $this->user1 = $user1;

        return $this;
    }
	
    /**
     * Get user1
     *
     * @return user
     */
    public function getUser1()
    {
        return $this->user1;
    }

      /**
     * Set user2
     *
     * @param user $user2
     * @return user
     */
      public function setUser2(\User\UserBundle\Entity\user $user2)
    {
        $this->user2 = $user2;

        return $this;
    }
	
    /**
     * Get user1
     *
     * @return user
     */
    public function getUser2()
    {
        return $this->user1;
    }

    /**
     * Set lastname
     *
     * @param integer $lastname
     * @return user
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer 
     */
    public function getStatus()
    {
        return $this->status;
    }
}
?>