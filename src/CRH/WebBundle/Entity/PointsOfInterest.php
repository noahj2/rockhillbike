<?php

namespace CRH\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * PointsOfInterest
 *
 * @ORM\Table(name="points_of_interest")
 * @ORM\Entity(repositoryClass="CRH\WebBundle\Repository\PointsOfInterestRepository")
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
     * @ORM\Column(name="longitude", type="decimal", precision=18, scale=16)
     */
    private $latitude;

    /**
     * @var float
     *
     * @ORM\Column(name="longitude", type="decimal", precision=18, scale=16)
     */
    private $longitude;
    
    /**
     * @var string
     *
     * @ORM\Column(name="photo", type="string", length=255, nullable=true)
     */
    private $photo;    

    /**
     * @var int
     *
     * @ORM\Column(name="trail", type="integer")
     * 
     * @ORM\ManyToOne(targetEntity="Trail", inversedBy("pointsOfInterest")
     */
    private $trail;

    /**
     * @var int
     *
     * @ORM\Column(name="type", type="integer")
     * 
     * @ORM\ManyToOne(targetEntity="POI_TYPE")
     */
    private $type;


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
}
