<?php

namespace CRH\WebBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * POI_TYPE
 *
 * @ORM\Table(name="p_o_i__t_y_p_e")
 * @ORM\Entity(repositoryClass="CRH\WebBundle\Repository\POI_TYPERepository")
 */
class POI_TYPE
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
     * @ORM\Column(name="Type", type="string", length=100, unique=true)
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
     * Set type
     *
     * @param string $type
     * @return POI_TYPE
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
}
