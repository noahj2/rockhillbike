<?php

namespace CRH\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Testimony
 *
 * @ORM\Table(name="testimony")
 * @ORM\Entity(repositoryClass="CRH\WebBundle\Repository\TestimonyRepository")
 */
class Testimony
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
     * @ORM\Column(name="image", type="string", length=255, nullable=true)
     */
    private $image;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=true)
     */
    private $message;

    /**
     * @var int
     *
     * @ORM\Column(name="trail", type="integer")
     * 
     * @ManyToOne(targetEntity="Trail", inversedBy("id")
     * @JoinColumn(name="trail", referencedColumnName="id")
     */
     
    private $trail;
    
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
     * Set image
     *
     * @param string $image
     * @return Testimony
     */
    public function setImage($image)
    {
        $this->image = $image;

        return $this;
    }

    /**
     * Get image
     *
     * @return string 
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return Testimony
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
}
