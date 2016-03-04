<?php

namespace CRH\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * FitnessTip
 *
 * @ORM\Table(name="fitness_tip")
 * @ORM\Entity(repositoryClass="CRH\WebBundle\Repository\FitnessTipRepository")
 */
class FitnessTip
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
     * @ORM\Column(name="tip", type="text")
     */
    private $tip;


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
     * Set tip
     *
     * @param string $tip
     * @return FitnessTip
     */
    public function setTip($tip)
    {
        $this->tip = $tip;

        return $this;
    }

    /**
     * Get tip
     *
     * @return string 
     */
    public function getTip()
    {
        return $this->tip;
    }
}
