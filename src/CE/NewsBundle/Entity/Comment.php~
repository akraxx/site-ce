<?php

namespace CE\NewsBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Comment
 *
 * @ORM\Table("ce_news_comment")
 * @ORM\Entity(repositoryClass="CE\NewsBundle\Entity\CommentRepository")
 */
class Comment
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
     * @var \DateTime
     * 
     * @Assert\DateTime(message = "Cette valeur n'est pas une date")
     * @ORM\Column(name="date", type="datetime")
     */
    private $date;
    
    /**
     * @var User $user
     *
     * @ORM\ManyToOne(targetEntity="CE\UserBundle\Entity\User", inversedBy="comments")
     */
    private $user;
    
    /**
     * @var string
     *
     * @Assert\Length(
     *      min = "10",
     *      minMessage = "Votre commentaire doit faire au moins {{ limit }} caractères"
     * )
     * @ORM\Column(name="content", type="text")
     */
    private $content;
    
    /**
    * @ORM\ManyToOne(targetEntity="CE\NewsBundle\Entity\Post", inversedBy="comments")
    * @ORM\JoinColumn(nullable=false)
    */
    private $post;
    
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
     * Set date
     *
     * @param \DateTime $date
     * @return Comment
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
     * Set user
     *
     * @param \CE\UserBundle\Entity\User $user
     * @return Comment
     */
    public function setUser(\CE\UserBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \CE\UserBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set content
     *
     * @param string $content
     * @return Comment
     */
    public function setContent($content)
    {
        $this->content = $content;
    
        return $this;
    }

    /**
     * Get content
     *
     * @return string 
     */
    public function getContent()
    {
        return $this->content;
    }
    
    public function __toString() {
        return $this->content . "";
    }

    /**
     * Set post
     *
     * @param \CE\NewsBundle\Entity\Post $post
     * @return Comment
     */
    public function setPost(\CE\NewsBundle\Entity\Post $post)
    {
        $this->post = $post;
    
        return $this;
    }

    /**
     * Get post
     *
     * @return \CE\NewsBundle\Entity\Post 
     */
    public function getPost()
    {
        return $this->post;
    }
}