<?php

namespace CRH\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Vich\UploaderBundle\Mapping\Annotation as Vich;

/**
 * PointsOfInterest
 *
 * @ORM\Table(name="points_of_interest")
 * @ORM\Entity(repositoryClass="CRH\WebBundle\Repository\PointsOfInterestRepository")
 * @Vich\Uploadable
 */
class PointsOfInterest
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
     * @var float
     *
     * @ORM\Column(name="latitude", type="decimal", precision=22, scale=20)
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="decimal", precision=22, scale=20)
     */
    private $longitude;
    
    /**
    *
    *@Vich\UploadableField(mapping="poi_image", fileNameProperty="photo")
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
    *@var \DateTime
    *
    *@ORM\Column(type="datetime")
    */
    private $updatedOn;

    /**
     * @var int
     *
     * 
     * @ORM\ManyToOne(targetEntity="Trail", inversedBy="pointsOfInterest")
     */
    private $trail;

    /**
     * @var int
     *
     * 
     * @ORM\ManyToOne(targetEntity="POI_TYPE")
     */
    private $type;

    //Constructor
    public function __construct()
    {
        $this->updatedOn = new \DateTime();
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
     * Set latitude
     *
     * @param float $latitude
     * @return PointsOfInterest
     */
    public function setLatitude($latitude)
    {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get latitude
     *
     * @return float 
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Set longitude
     *
     * @param float $longitude
     * @return PointsOfInterest
     */
    public function setLongitude($longitude)
    {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get longitude
     *
     * @return float 
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Set trail
     *
     * @param integer $trail
     * @return PointsOfInterest
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
     * Set type
     *
     * @param integer $type
     * @return PointsOfInterest
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return integer 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param File|\Symfony\Component\HttpFoundation\File\UploadedFile $image
     * 
     * @return PointsOfInterest
     */ 
    public function setImageFile(File $image = null)
    {
        $this->imageFile = $image;
        
        if($image)
        {
            $this->updatedOn = new \DateTime('now');
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
      * @return updatedOn 
      */
      public function getUpdatedOn()
      {
          return $this->updatedOn;
      }
      
    /**
     * Set photo
     *
     * @param string $photo
     * @return PointsOfInterest
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
