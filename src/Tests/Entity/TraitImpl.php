<?php

namespace DemonTPx\UtilBundle\Tests\Entity;

use DemonTPx\UtilBundle\Entity\DateCreatedTrait;
use DemonTPx\UtilBundle\Entity\DateUpdatedTrait;
use DemonTPx\UtilBundle\Entity\IdTrait;

/**
 * Class TraitImpl
 *
 * @package   DemonTPx\UtilBundle\Tests\Entity
 * @author    Bert Hekman <demontpx@gmail.com>
 * @copyright 2014 Bert Hekman
 */
class TraitImpl
{
    use IdTrait, DateCreatedTrait, DateUpdatedTrait;
}
