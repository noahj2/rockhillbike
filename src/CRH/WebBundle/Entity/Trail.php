<?php

namespace CRH\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\Validator\Constraints as Assert;


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
     * @var string
     *
     * @ORM\Column(name="hoursOfOperation", type="text")
     */
    private $hoursOfOperation;

    /**
     * @var float
     *
     * @ORM\Column(name="length", type="float")
     */
    private $length;
    
    
    /**
     * @var float
     *
     * @ORM\Column(name="isTrailOfMonth", type="boolean")
     */
    private $isTrailOfMonth = false;
    
    /**
     * @ORM\OneToOne(targetEntity="Location")
     */
     private $location;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=25)
     * @Assert\Choice(choices = {"Trails", "Sidewalks", "Special Ways", "Blue Ways"}, message = "Choose the primary type of this entity.")
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
     * @ORM\OneToMany(targetEntity="Comment", mappedBy="trail", cascade="ALL", cascade="ALL")
     * 
     */
    private $comments;
    
    /**
     * @ORM\OneToMany(targetEntity="Event", mappedBy="location", cascade="ALL", cascade="ALL")
     */ 
    private $events;
    
    /**
     * @ORM\OneToMany(targetEntity="PointsOfInterest", mappedBy="trail", cascade="ALL")
     */
     private $pointsOfInterest;
     
    /**
     * @ORM\OneToMany(targetEntity="RoutePoint", mappedBy="trail", cascade="ALL")
     * 
     */
    private $routePoints;     
    
    //Constructor
    public function __construct()
    {
        $this->updatedOn = new \DateTime();
        $this->comments = new ArrayCollection();
        $this->events = new ArrayCollection();
        $this->pointsOfInterest = new ArrayCollection();
        $this->routePoints = new ArrayCollection();
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
     * @param string $description	F
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
    public function setImageFile1(File $image = null)
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
      * @return updatedOn 
      */
      public function getUpdatedOn()
      {
          return $this->updatedOn;
      }
      
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
    
    /**
     * Add RoutePoint
     *
     * @param \CRH\WebBundle\Entity\RoutePoint $routePoints
     * @return Trail
     */
    public function addRoutePoint(\CRH\WebBundle\Entity\RoutePoint $routePoints)
    {
        $this->routePoints[] = $routePoints;

        return $this;
    }

    /**
     * Remove RoutePoints
     *
     * @param \CRH\WebBundle\Entity\RoutePoint $routePoints
     */
    public function removeRoutePoints(\CRH\WebBundle\Entity\RoutePoint $routePoints)
    {
        $this->routePoints->removeElement($routePoints);
    }

    /**
     * Get RoutePoints
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRoutePoints()
    {
        return $this->routePoints;
    }    
    
    public function __toString()
    {
        return $this->name;
    }
    
    public function getIsTrailOfMonth()
    {
        return $this->isTrailOfMonth;
    }
    
    public function setIsTrailOfMonth($isTrailOfMonth)
    {
        $this->isTrailOfMonth = $isTrailOfMonth;
    
    }
    
    public function getHoursOfOperation()
    {
        return $this->hoursOfOperation;
    }
    
    public function setHoursOfOperation($hoursOfOperation)
    {
        $this->hoursOfOperation = $hoursOfOperation;
        
        return $this;
    }
    
}
