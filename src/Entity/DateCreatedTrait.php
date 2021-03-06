<?php declare(strict_types=1);

namespace Demontpx\UtilBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @copyright 2014 Bert Hekman
 */
trait DateCreatedTrait
{
    /** @ORM\Column(type="datetime") */
    private ?\DateTimeInterface $dateCreated = null;

    /** @ORM\PrePersist */
    public function setDateCreatedNow()
    {
        $this->dateCreated = new \DateTime();
    }

    public function getDateCreated(): ?\DateTimeInterface
    {
        return $this->dateCreated;
    }

    public function setDateCreated(\DateTimeInterface $dateCreated)
    {
        $this->dateCreated = $dateCreated;
    }
}
