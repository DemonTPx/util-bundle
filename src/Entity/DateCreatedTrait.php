<?php

namespace Demontpx\UtilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DateCreatedTrait
 *
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

    public function getDateCreated(): ?\DateTime
    {
        return $this->dateCreated;
    }

    /**
     * @param \DateTime $dateCreated
     */
    public function setDateCreated(?\DateTime $dateCreated)
    {
        $this->dateCreated = $dateCreated;
    }
}
