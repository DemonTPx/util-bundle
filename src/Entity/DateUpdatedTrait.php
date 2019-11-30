<?php declare(strict_types=1);

namespace Demontpx\UtilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @copyright 2014 Bert Hekman
 */
trait DateUpdatedTrait
{
    /** @ORM\Column(type="datetime", nullable=true) */
    private ?\DateTimeInterface $dateUpdated = null;

    /** @ORM\PreUpdate */
    public function setDateUpdatedNow()
    {
        $this->dateUpdated = new \DateTime();
    }

    public function getDateUpdated(): ?\DateTimeInterface
    {
        return $this->dateUpdated;
    }

    public function setDateUpdated(?\DateTimeInterface $dateUpdated)
    {
        $this->dateUpdated = $dateUpdated;
    }
}
