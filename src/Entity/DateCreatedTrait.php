<?php

namespace DemonTPx\UtilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DateCreatedTrait
 *
 * @package   DemonTPx\AdministrationBundle\Entity
 * @author    Bert Hekman <demontpx@gmail.com>
 * @copyright 2014 Bert Hekman
 */
trait DateCreatedTrait
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(type="datetime")
     */
    private $dateCreated;

    /**
     * @ORM\PrePersist
     */
    public function setDateCreatedNow()
    {
        $this->dateCreated = new \DateTime();
    }

    /**
     * @return \DateTime
     */
    public function getDateCreated()
    {
        return $this->dateCreated;
    }

    /**
     * @param \DateTime $dateCreated
     */
    public function setDateCreated($dateCreated)
    {
        $this->dateCreated = $dateCreated;
    }
}
