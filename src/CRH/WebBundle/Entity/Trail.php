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
    private $name = "";
    
    
    /**
     * @var string
     *
     * @ORM\Column(name="hoursOfOperation", type="text")
     * @Assert\NotNull(message="Please provide hours of operation for the trail.")
     */
    private $hoursOfOperation = "";

    /**
     * @var float
     *
     * @ORM\Column(name="length", type="float")
     */
    private $length = 0;
    
    

    /**
     * @var boolean
     *
     * @ORM\Column(name="allowsBikes", type="boolean")
     */
    private $allowsBikes = false;
    
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="handicapAccess", type="boolean")
     */
    private $handicapAccess = false;
    
    
    
    
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
     * @var string
     *
     * @ORM\Column(name="surfaceType", type="string", length=50)
     * @Assert\Choice(choices = {"Asphalt", "Concrete", "Natural", "Water"}, message = "Choose the primary surface type.")
     */
    private $surfaceType;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text")
     * @Assert\NotNull(message="Please provide a short description of the trail.")
     */
    private $description = "";
    
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
    *
    *@Vich\UploadableField(mapping="trail_banner1", fileNameProperty="bannerPhoto1")
     * @Assert\Image(
     *     minWidth = 2400,
     *     maxWidth = 2400,
     *     minHeight = 600,
     *     maxHeight = 600
     * )
    *
    */
    private $bannerImageFile1;
    
    /**
     * @var string
     *
     * @ORM\Column(name="bannerPhoto1", type="string", length=255, nullable=true)
     */
    private $bannerPhoto1;



    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     * 
     * @return Trail
     */ 
    public function setBannerImageFile1(File $image = null)
    {
        $this->bannerImageFile1 = $image;
        
        if($image)
        {
            $this->updatedOn = new \DateTime('now');
        }
        return $this;
    }
    
    /**
     * @return File
     */
     public function getBannerImageFile1()
     {
         return $this->bannerImageFile1;
     }
     
     
    /**
     * Set bannerPhoto1
     *
     * @param string $bannerPhoto1
     * @return Trail
     */
    public function setBannerPhoto1($bannerPhoto1)
    {
        $this->bannerPhoto1 = $bannerPhoto1;

        return $this;
    }

    /**
     * Get bannerPhoto1
     *
     * @return string 
     */
    public function getBannerPhoto1()
    {
        return $this->bannerPhoto1;
    }































    /**
    *
    *@Vich\UploadableField(mapping="trail_photo1", fileNameProperty="photo1")
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
    *
    *@Vich\UploadableField(mapping="trail_photo2", fileNameProperty="photo2")
    *
    */
    private $imageFile2;
    
    /**
     * @var string
     *
     * @ORM\Column(name="photo2", type="string", length=255, nullable=true)
     */
    private $photo2;



    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     * 
     * @return Trail
     */ 
    public function setImageFile2(File $image = null)
    {
        $this->imageFile2 = $image;
        
        if($image)
        {
            $this->updatedOn = new \DateTime('now');
        }
        return $this;
    }
    
    /**
     * @return File
     */
     public function getImageFile2()
     {
         return $this->imageFile2;
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
    *
    *@Vich\UploadableField(mapping="trail_photo3", fileNameProperty="photo3")
    *
    */
    private $imageFile3;
    
    /**
     * @var string
     *
     * @ORM\Column(name="photo3", type="string", length=255, nullable=true)
     */
    private $photo3;



    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     * 
     * @return Trail
     */ 
    public function setImageFile3(File $image = null)
    {
        $this->imageFile3 = $image;
        
        if($image)
        {
            $this->updatedOn = new \DateTime('now');
        }
        return $this;
    }
    
    /**
     * @return File
     */
     public function getImageFile3()
     {
         return $this->imageFile3;
     }
     
     
    /**
     * Set photo3
     *
     * @param string $photo3
     * @return Trail
     */
    public function setPhoto3($photo3)
    {
        $this->photo3 = $photo3;

        return $this;
    }

    /**
     * Get photo3
     *
     * @return string 
     */
    public function getPhoto3()
    {
        return $this->photo3;
    }

     
     
     
     
     
     
     



    /**
    *
    *@Vich\UploadableField(mapping="trail_photo4", fileNameProperty="photo4")
    *
    */
    private $imageFile4;
    
    /**
     * @var string
     *
     * @ORM\Column(name="photo4", type="string", length=255, nullable=true)
     */
    private $photo4;



    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     * 
     * @return Trail
     */ 
    public function setImageFile4(File $image = null)
    {
        $this->imageFile4 = $image;
        
        if($image)
        {
            $this->updatedOn = new \DateTime('now');
        }
        return $this;
    }
    
    /**
     * @return File
     */
     public function getImageFile4()
     {
         return $this->imageFile4;
     }
     
     
    /**
     * Set photo4
     *
     * @param string $photo1
     * @return Trail
     */
    public function setPhoto4($photo4)
    {
        $this->photo4 = $photo4;

        return $this;
    }

    /**
     * Get photo4
     *
     * @return string 
     */
    public function getPhoto4()
    {
        return $this->photo4;
    }

     
     
     
     
     
     
     
     
     
     
     
     
     
     
     
     /**
      * @return updatedOn 
      */
      public function getUpdatedOn()
      {
          return $this->updatedOn;
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
    
    
    public function getAllowsBikes()
    {
        return $this->allowsBikes;
    }
    
    public function setAllowsBikes($allowsBikes)
    {
        $this->allowsBikes = $allowsBikes;
        
        return $this;
    }
    
    
    public function getHandicapAccess()
    {
        return $this->handicapAccess;
    }
    
    public function setHandicapAccess($handicapAccess)
    {
        $this->handicapAccess = $handicapAccess;
        
        return $this;
    }
    

}
