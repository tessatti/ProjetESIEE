<?php

namespace Article\ArticleBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * article
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Article\ArticleBundle\Entity\articleRepository")
 */
class article
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="text", type="string", length=400)
     */
    private $text;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="timestamp", type="datetime")
     */
    private $timestamp;

	/**
	 * @var integer
	 * @ORM\ManyToOne(targetEntity="User\UserBundle\Entity\user")
	 * @ORM\JoinColumn(nullable=false)
     */
	 private $user;
	 
	 //Constructor
	 public function __construct()
	 {
		$this->timestamp = new \Datetime();
		$this->title = NULL;
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
     * Set title
     *
     * @param string $title
     * @return article
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string 
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set userID
     *
     * @param integer $userID
     * @return article
     */
    public function setUserID(\User\UserBundle\Entity\user $user)
    {
        $this->user = $user;
		
        return $this;
    }

    /**
     * Get userID
     *
     * @return integer 
     */
    public function getUserID()
    {
        return $this->user;
    }

    /**
     * Set text
     *
     * @param string $text
     * @return article
     */
    public function setText($text)
    {
        $this->text = $text;

        return $this;
    }

    /**
     * Get text
     *
     * @return string 
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * Set timestamp
     *
     * @param \DateTime $timestamp
     * @return article
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime 
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }
}
