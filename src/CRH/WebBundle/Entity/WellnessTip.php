<?php

namespace CRH\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * WellnessTip
 *
 * @ORM\Table(name="wellness_tip")
 * @ORM\Entity(repositoryClass="CRH\WebBundle\Repository\WellnessTipRepository")
 */
class WellnessTip
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
     * @var boolean
     *
     * @ORM\Column(name="isTipOfMonth", type="boolean")
     */
    private $isTipOfMonth = false;

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
     * @return WellnessTip
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
    
    public function getIsTipOfMonth()
    {
        return $this->isTipOfMonth;
    }
    
    public function setIsTipOfMonth($isTipOfMonth)
    {
        $this->isTipOfMonth= $isTipOfMonth;
    }
    
    
    
}
