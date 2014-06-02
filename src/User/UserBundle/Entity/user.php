<?php

namespace User\UserBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use User\UserBundle\Entity\user;

/**
 * user
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="User\UserBundle\Entity\userRepository")
 */
class user
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
     * @var string
     *
     * @ORM\Column(name="firstname", type="string", length=255)
     */
    private $firstname;

    /**
     * @var string
     *
     * @ORM\Column(name="lastname", type="string", length=255)
     */
    private $lastname;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;
	
	/**
     * @var date
     *
     * @ORM\Column(name="date", type="date")
     */
	private $date;

	/**
     * @ORM\ManyToMany(targetEntity="User\UserBundle\Entity\user", cascade={"persist"})
	 * @var ArrayCollection $followers
     */
    private $followers;
	
  // On defini followers dans le constructeur en tant qu'ArrayCollection :
  public function __construct()
  {
    $this->followers = new \Doctrine\Common\Collections\ArrayCollection();
	$this->date = new \Datetime();
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
     * Set firstname
     *
     * @param string $firstname
     * @return user
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string 
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     * @return user
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string 
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return user
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
     * @return user
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
    * Add followers
    *
    * @param User\UserBundle\Entity\User $followers
    */
	public function addFollower(\User\UserBundle\Entity\User $follower)
	{
		$this->followers[] = $follower;
	}
	
	/**
    * Remove followers
    *
    * @param User\UserBundle\Entity\User $followers
    */
	public function removeFollower(\User\UserBundle\Entity\User $follower)
	{
		$this->followers->removeElement($follower);
	}
  
    /**
    * Get followers
    *
    * @return Doctrine\Common\Collections\Collection
    */
	public function getFollowers() 
	{
		return $this->followers;
	}
}
