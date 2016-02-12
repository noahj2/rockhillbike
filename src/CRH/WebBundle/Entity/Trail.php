<?php

namespace CRH\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Trail
 *
 * @ORM\Table(name="trail")
 * @ORM\Entity(repositoryClass="CRH\WebBundle\Repository\TrailRepository")
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
}