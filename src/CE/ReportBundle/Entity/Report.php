<?php

namespace CE\ReportBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Report
 *
 * @ORM\Table("ce_report_item")
 * @ORM\Entity(repositoryClass="CE\ReportBundle\Entity\ReportRepository")
 */
class Report
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
     * @ORM\Column(name="description", type="text")
     * 
     * @Assert\NotBlank(message = "Ce champ ne peut pas être nul")
     * @Assert\Length(
     *      min = "5",
     *      minMessage = "Votre description doit faire au moins {{ limit }} caractères"
     * )
     */
    private $description;

    /**
     * @var \DateTime
     * 
     * @ORM\Column(name="meeting_date", type="date")
     */
    private $meetingDate;

    /**
     * @var \DateTime
     *
     * @Assert\DateTime(message = "Cette valeur n'est pas une date")
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    
    /**
     * @var Media $file
     *
     * @ORM\ManyToOne(targetEntity="Application\Sonata\MediaBundle\Entity\Media", cascade={"all"})
     */
    private $file;

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
     * @return Report
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
     * Set description
     *
     * @param string $description
     * @return Report
     */
    public function setDescription($description)
    {
        $this->description = $description;
    
        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set meetingDate
     *
     * @param \DateTime $meetingDate
     * @return Report
     */
    public function setMeetingDate($meetingDate)
    {
        $this->meetingDate = $meetingDate;
    
        return $this;
    }

    /**
     * Get meetingDate
     *
     * @return \DateTime 
     */
    public function getMeetingDate()
    {
        return $this->meetingDate;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Report
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
     * Set file
     *
     * @param \Application\Sonata\MediaBundle\Entity\Media $file
     * @return Report
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
    
    public function __toString() {
        return $this->title . "";
    }
}