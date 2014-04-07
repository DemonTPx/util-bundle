<?php

namespace DemonTPx\UtilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DateUpdatedTrait
 *
 * @package   DemonTPx\AdministrationBundle\Entity
 * @author    Bert Hekman <demontpx@gmail.com>
 * @copyright 2014 Bert Hekman
 */
trait DateUpdatedTrait
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $dateUpdated;

    /**
     * @ORM\OnUpdate
     */
    public function setDateUpdatedNow()
    {
        $this->$dateUpdated = new \DateTime();
    }

    /**
     * @return \DateTime
     */
    public function getDateUpdated()
    {
        return $this->$dateUpdated;
    }

    /**
     * @param \DateTime $dateUpdated
     */
    public function setDateUpdated($dateUpdated)
    {
        $this->$dateUpdated = $dateUpdated;
    }
}
