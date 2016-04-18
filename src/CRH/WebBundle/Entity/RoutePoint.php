<?php

namespace CRH\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RoutePoint
 *
 * @ORM\Table(name="route_point")
 * @ORM\Entity(repositoryClass="CRH\WebBundle\Repository\RoutePointRepository")
 */
class RoutePoint
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
     * @ORM\Column(name="startLat", type="decimal", precision=22, scale=20)
     */
    private $startLat;

    /**
     * @var string
     *
     * @ORM\Column(name="startLng", type="decimal", precision=22, scale=20)
     */
    private $startLng;

    /**
     * @var string
     *
     * @ORM\Column(name="endLat", type="decimal", precision=22, scale=20)
     */
    private $endLat;

    /**
     * @var string
     *
     * @ORM\Column(name="endLng", type="decimal", precision=22, scale=20)
     */
    private $endLng;

    /**
     * @ORM\ManyToOne(targetEntity="Trail", inversedBy="routePoints")
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
     * Set startLat
     *
     * @param string $startLat
     * @return RoutePoint
     */
    public function setStartLat($startLat)
    {
        $this->startLat = $startLat;

        return $this;
    }

    /**
     * Get startLat
     *
     * @return string 
     */
    public function getStartLat()
    {
        return $this->startLat;
    }

    /**
     * Set startLng
     *
     * @param string $startLng
     * @return RoutePoint
     */
    public function setStartLng($startLng)
    {
        $this->startLng = $startLng;

        return $this;
    }

    /**
     * Get startLng
     *
     * @return string 
     */
    public function getStartLng()
    {
        return $this->startLng;
    }

    /**
     * Set endLat
     *
     * @param string $endLat
     * @return RoutePoint
     */
    public function setEndLat($endLat)
    {
        $this->endLat = $endLat;

        return $this;
    }

    /**
     * Get endLat
     *
     * @return string 
     */
    public function getEndLat()
    {
        return $this->endLat;
    }

    /**
     * Set endLng
     *
     * @param string $endLng
     * @return RoutePoint
     */
    public function setEndLng($endLng)
    {
        $this->endLng = $endLng;

        return $this;
    }

    /**
     * Get endLng
     *
     * @return string 
     */
    public function getEndLng()
    {
        return $this->endLng;
    }

    /**
     * Set trail
     *
     * @param integer $trail
     * @return RoutePoint
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
}
