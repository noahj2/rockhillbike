<?php

namespace CRH\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Comment
 *
 * @ORM\Table(name="comment")
 * @ORM\Entity(repositoryClass="CRH\WebBundle\Repository\CommentRepository")
 * @Vich\Uploadable
 */
class Comment
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=100, nullable=true)
     * @Assert\NotBlank()
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=true)
     * @Assert\NotBlank()
     */
    private $message;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;

    /**
     * @ORM\ManyToOne(targetEntity="Trail", inversedBy="comments")
     */
    private $trail;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, nullable=true)
     * @Assert\Email(message = "The email is not a valid email.")
     */
    private $email;

    /**
     * @ORM\Column(name="isapproved", type="boolean")
     * 
     * 
     */
    private $isApproved = false;
    
    public function __construct()
    {
        $this->date = new \DateTime();
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
     * Set name
     *
     * @param string $name
     * @return Comment
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
     * Set message
     *
     * @param string $message
     * @return Comment
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
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
     * Set trail
     *
     * @param integer $trail
     * @return Comment
     */
    public function setTrail($trail)
    {
        $this->trail = $trail;

        return $this;
    }

    /**
     * Get trail
     *
     * @return integer 
     */
    public function getTrail()
    {
        return $this->trail;
    }
    
    /**
     * Set isApproved
     * 
     * @param boolean $isApproved
     * @return Comment
     */ 
    public function setIsApproved($isApproved)
    {
        $this->isApproved = $isApproved;
        return $this;
    }
    
    /**
     * Get isApproved
     * 
     * @return boolean
     */ 
    public function getIsApproved()
    {
        return $this->isApproved;
    }
    
    /**
     * Set email
     *
     * @param string $email
     * @return Comment
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
    *
    *@Vich\UploadableField(mapping="comment_photo", fileNameProperty="photo")
    *
    */
    private $imageFile;
    
    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;



    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     * 
     * @return Comment
     */ 
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;
        
        if($image)
        {
            $this->date = new \DateTime('now');
        }
        return $this;
    }
    
    /**
     * @return File
     */
     public function getImageFile()
     {
         return $this->imageFile;
     }
     
     
    /**
     * Set photo
     *
     * @param string $photo
     * @return Trail
     */
    public function setPhoto($photo)
    {
        $this->photo = $photo;

        return $this;
    }

    /**
     * Get photo
     *
     * @return string 
     */
    public function getPhoto()
    {
        return $this->photo;
    }

}
