<?php

namespace CE\ActivityBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Activity
 *
 * @ORM\Table("ce_activity_item")
 * @ORM\Entity(repositoryClass="CE\ActivityBundle\Entity\ActivityRepository")
 */
class Activity
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
     * 
     * @Assert\NotBlank(message = "Ce champ ne peut pas être nul")
     * @Assert\Length(
     *      min = "2",
     *      max = "50",
     *      minMessage = "Votre titre doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre titre ne peut pas être plus long que {{ limit }} caractères"
     * )
     */
    private $title;

    /**
     * @var string
     * 
     * @Assert\NotBlank(message = "Ce champ ne peut pas être nul")
     * @Assert\Length(
     *      min = "4",
     *      max = "255",
     *      minMessage = "Votre lieu doit faire au moins {{ limit }} caractères",
     *      maxMessage = "Votre lieu ne peut pas être plus long que {{ limit }} caractères"
     * )
     * @ORM\Column(name="place", type="string", length=255)
     */
    private $place;

    /**
     * @var float
     * 
     * @Assert\NotBlank(message = "Ce champ ne peut pas être nul")
     * @Assert\Range(
     *      min = 0,
     *      minMessage = "Le prix de minimum doit être de 0€",
     *      invalidMessage = "Cette valeur n'est pas un nombre"
     * )
     * @ORM\Column(name="price", type="float")
     */
    private $price;

    /**
     * @var integer
     *
     * @Assert\Range(
     *      min = 0,
     *      minMessage = "Le nombre de places minimum est de 0",
     *      invalidMessage = "Cette valeur n'est pas un nombre"
     * )
     * @ORM\Column(name="available_tickets", type="integer", nullable=true)
     */
    private $availableTickets;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime(message = "Cette valeur n'est pas une date")
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;

    /**
     * @var string
     * 
     * @Assert\NotBlank(message = "Ce champ ne peut pas être nul")
     * @Assert\Length(
     *      min = "10",
     *      minMessage = "Votre commentaire doit faire au moins {{ limit }} caractères"
     * )
     * @ORM\Column(name="comment", type="text")
     */
    private $comment;

    /**
     * @var Media $file
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media")
     */
    private $file;
    
    /**
     * @var Category $category
     *
     * @ORM\ManyToOne(targetEntity="CE\ActivityBundle\Entity\Category", inversedBy="activities")
     */
    private $category;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="active", type="boolean")
     */
    private $active = true;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="onTop", type="boolean")
     */
    private $onTop = false;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="contactAdmin", type="boolean")
     */
    private $contactAdmin = false;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="hiddenPrice", type="boolean")
     */
    private $hiddenPrice = false;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="protectedFile", type="boolean")
     */
    private $protectedFile = false;
    
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
     * @return Activity
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
     * Set place
     *
     * @param string $place
     * @return Activity
     */
    public function setPlace($place)
    {
        $this->place = $place;
    
        return $this;
    }

    /**
     * Get place
     *
     * @return string 
     */
    public function getPlace()
    {
        return $this->place;
    }

    /**
     * Set price
     *
     * @param float $price
     * @return Activity
     */
    public function setPrice($price)
    {
        $this->price = $price;
    
        return $this;
    }

    /**
     * Get price
     *
     * @return float 
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set availableTickets
     *
     * @param integer $availableTickets
     * @return Activity
     */
    public function setAvailableTickets($availableTickets)
    {
        $this->availableTickets = $availableTickets;
    
        return $this;
    }

    /**
     * Get availableTickets
     *
     * @return integer 
     */
    public function getAvailableTickets()
    {
        return $this->availableTickets;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Activity
     */
    public function setDate($date)
    {
        $this->date = $date;
    
        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set comment
     *
     * @param string $comment
     * @return Activity
     */
    public function setComment($comment)
    {
        $this->comment = $comment;
    
        return $this;
    }

    /**
     * Get comment
     *
     * @return string 
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * Set file
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $file
     * @return Activity
     */
    public function setFile(\Application\Sonata\MediaBundle\Entity\Media $file = null)
    {
        $this->file = $file;
    
        return $this;
    }

    /**
     * Get file
     *
     * @return \Application\Sonata\MediaBundle\Entity\Media 
     */
    public function getFile()
    {
        return $this->file;
    }

    /**
     * Set category
     *
     * @param \CE\ActivityBundle\Entity\Category $category
     * @return Activity
     */
    public function setCategory(\CE\ActivityBundle\Entity\Category $category = null)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return \CE\ActivityBundle\Entity\Category 
     */
    public function getCategory()
    {
        return $this->category;
    }
    
    public function __toString() {
        return $this->title . "";
    }

    /**
     * Set active
     *
     * @param boolean $active
     * @return Activity
     */
    public function setActive($active)
    {
        $this->active = $active;
    
        return $this;
    }

    /**
     * Get active
     *
     * @return boolean 
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * Set onTop
     *
     * @param boolean $onTop
     * @return Activity
     */
    public function setOnTop($onTop)
    {
        $this->onTop = $onTop;
    
        return $this;
    }

    /**
     * Get onTop
     *
     * @return boolean 
     */
    public function getOnTop()
    {
        return $this->onTop;
    }

    /**
     * Set protectedFile
     *
     * @param boolean $protectedFile
     * @return Activity
     */
    public function setProtectedFile($protectedFile)
    {
        $this->protectedFile = $protectedFile;
    
        return $this;
    }

    /**
     * Get protectedFile
     *
     * @return boolean 
     */
    public function getProtectedFile()
    {
        return $this->protectedFile;
    }

    /**
     * Set contactAdmin
     *
     * @param boolean $contactAdmin
     * @return Activity
     */
    public function setContactAdmin($contactAdmin)
    {
        $this->contactAdmin = $contactAdmin;
    
        return $this;
    }

    /**
     * Get contactAdmin
     *
     * @return boolean 
     */
    public function getContactAdmin()
    {
        return $this->contactAdmin;
    }

    /**
     * Set hiddenPrice
     *
     * @param boolean $hiddenPrice
     * @return Activity
     */
    public function setHiddenPrice($hiddenPrice)
    {
        $this->hiddenPrice = $hiddenPrice;
    
        return $this;
    }

    /**
     * Get hiddenPrice
     *
     * @return boolean 
     */
    public function getHiddenPrice()
    {
        return $this->hiddenPrice;
    }
}