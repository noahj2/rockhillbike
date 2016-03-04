<?php

namespace CRH\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * Trail
 *
 * @ORM\Table(name="trail")
 * @ORM\Entity(repositoryClass="CRH\WebBundle\Repository\TrailRepository")
 * @Vich\Uploadable
 */
class Trail
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
     * @ORM\Column(name="name", type="string", length=255, unique=true)
     */
    private $name;

    /**
     * @var float
     *
     * @ORM\Column(name="length", type="float")
     */
    private $length;
    
    /**
     * @ORM\OneToOne(targetEntity="Location")
     */
     private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=25)
     */
    private $type;

    /**
     * @var float
     *
     * @ORM\Column(name="caloriesBurnedMale", type="float", nullable=true)
     */
    private $caloriesBurnedMale;

    /**
     * @var float
     *
     * @ORM\Column(name="caloriesBurnedFemale", type="float", nullable=true)
     */
    private $caloriesBurnedFemale;

    /**
     * @var string
     *
     * @ORM\Column(name="surfaceType", type="string", length=50)
     */
    private $surfaceType;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     */
    private $description;
    
    /**
    *
    *@Vich\UploadableField(mapping="trail_image", fileNameProperty="photo1")
    *
    */
    
    private $imageFile1;
    /**
     * @var string
     *
     * @ORM\Column(name="photo1", type="string", length=255, nullable=true)
     */
    private $photo1;
    
    /**
    *@var \DateTime
    *
    *@ORM\Column(type="datetime")
    */
    private $updatedOn;
    
    /**
     * @var string
     *
     * @ORM\Column(name="photo2", type="string", length=255, nullable=true)
     */
    private $photo2;
    
    /**
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="trail")
     */
    private $comments;
    
    /**
     * @ORM\OneToMany(targetEntity="Event", mappedBy="location")
     */ 
    private $events;
    
    /**
     * @ORM\OneToMany(targetEntity="PointsOfInterest", mappedBy="trail")
     */
     private $pointsOfInterest;
    
    //Constructor
    public function __construct()
    {
        $this->comments = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->pointsOfInterest = new ArrayCollection();
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
     * @return Trail
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
     * Set length
     *
     * @param float $length
     * @return Trail
     */
    public function setLength($length)
    {
        $this->length = $length;

        return $this;
    }

    /**
     * Get length
     *
     * @return float 
     */
    public function getLength()
    {
        return $this->length;
    }

    /**
     * Set caloriesBurnedMale
     *
     * @param float $caloriesBurnedMale
     * @return Trail
     */
    public function setCaloriesBurnedMale($caloriesBurnedMale)
    {
        $this->caloriesBurnedMale = $caloriesBurnedMale;

        return $this;
    }

    /**
     * Get caloriesBurnedMale
     *
     * @return float 
     */
    public function getCaloriesBurnedMale()
    {
        return $this->caloriesBurnedMale;
    }

    /**
     * Set caloriesBurnedFemale
     *
     * @param float $caloriesBurnedFemale
     * @return Trail
     */
    public function setCaloriesBurnedFemale($caloriesBurnedFemale)
    {
        $this->caloriesBurnedFemale = $caloriesBurnedFemale;

        return $this;
    }

    /**
     * Get caloriesBurnedFemale
     *
     * @return float 
     */
    public function getCaloriesBurnedFemale()
    {
        return $this->caloriesBurnedFemale;
    }

    /**
     * Set surfaceType
     *
     * @param string $surfaceType
     * @return Trail
     */
    public function setSurfaceType($surfaceType)
    {
        $this->surfaceType = $surfaceType;

        return $this;
    }

    /**
     * Get surfaceType
     *
     * @return string 
     */
    public function getSurfaceType()
    {
        return $this->surfaceType;
    }

    /**
     * Set description
     *
     * @param string $description
     * @return Trail
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
     * Set type
     *
     * @param string $type
     * @return Trail
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     * 
     * @return Trail
     */ 
    public function setImageFile(File $image = null)
    {
        $this->imageFile1 = $image;
        
        if($image)
        {
            $this->updatedOn = new \DateTime('now');
        }
        return $this;
    }
    
    /**
     * @return File
     */
     public function getImageFile1()
     {
         return $this->imageFile1;
     }
     
     /**
      * 
      */
      
     
    /**
     * Set photo1
     *
     * @param string $photo1
     * @return Trail
     */
    public function setPhoto1($photo1)
    {
        $this->photo1 = $photo1;

        return $this;
    }

    /**
     * Get photo1
     *
     * @return string 
     */
    public function getPhoto1()
    {
        return $this->photo1;
    }

    /**
     * Set photo2
     *
     * @param string $photo2
     * @return Trail
     */
    public function setPhoto2($photo2)
    {
        $this->photo2 = $photo2;

        return $this;
    }

    /**
     * Get photo2
     *
     * @return string 
     */
    public function getPhoto2()
    {
        return $this->photo2;
    }

    /**
     * Set location
     *
     * @param \CRH\WebBundle\Entity\Location $location
     * @return Trail
     */
    public function setLocation(\CRH\WebBundle\Entity\Location $location = null)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return \CRH\WebBundle\Entity\Location 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Add comments
     *
     * @param \CRH\WebBundle\Entity\Comment $comments
     * @return Trail
     */
    public function addComment(\CRH\WebBundle\Entity\Comment $comments)
    {
        $this->comments[] = $comments;

        return $this;
    }

    /**
     * Remove comments
     *
     * @param \CRH\WebBundle\Entity\Comment $comments
     */
    public function removeComment(\CRH\WebBundle\Entity\Comment $comments)
    {
        $this->comments->removeElement($comments);
    }

    /**
     * Get comments
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getComments()
    {
        return $this->comments;
    }

    /**
     * Add events
     *
     * @param \CRH\WebBundle\Entity\Event $events
     * @return Trail
     */
    public function addEvent(\CRH\WebBundle\Entity\Event $events)
    {
        $this->events[] = $events;

        return $this;
    }

    /**
     * Remove events
     *
     * @param \CRH\WebBundle\Entity\Event $events
     */
    public function removeEvent(\CRH\WebBundle\Entity\Event $events)
    {
        $this->events->removeElement($events);
    }

    /**
     * Get events
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEvents()
    {
        return $this->events;
    }

    /**
     * Add pointsOfInterest
     *
     * @param \CRH\WebBundle\Entity\PointsOfInterest $pointsOfInterest
     * @return Trail
     */
    public function addPointsOfInterest(\CRH\WebBundle\Entity\PointsOfInterest $pointsOfInterest)
    {
        $this->pointsOfInterest[] = $pointsOfInterest;

        return $this;
    }

    /**
     * Remove pointsOfInterest
     *
     * @param \CRH\WebBundle\Entity\PointsOfInterest $pointsOfInterest
     */
    public function removePointsOfInterest(\CRH\WebBundle\Entity\PointsOfInterest $pointsOfInterest)
    {
        $this->pointsOfInterest->removeElement($pointsOfInterest);
    }

    /**
     * Get pointsOfInterest
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getPointsOfInterest()
    {
        return $this->pointsOfInterest;
    }
}
