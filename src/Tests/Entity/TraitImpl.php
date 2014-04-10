<?php

namespace Demontpx\UtilBundle\Tests\Entity;

use Demontpx\UtilBundle\Entity\DateCreatedTrait;
use Demontpx\UtilBundle\Entity\DateUpdatedTrait;
use Demontpx\UtilBundle\Entity\IdTrait;

/**
 * Class TraitImpl
 *
 * @package   Demontpx\UtilBundle\Tests\Entity
 * @author    Bert Hekman <demontpx@gmail.com>
 * @copyright 2014 Bert Hekman
 */
class TraitImpl
{
    use IdTrait, DateCreatedTrait, DateUpdatedTrait;
}
