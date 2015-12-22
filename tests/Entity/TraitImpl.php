<?php

namespace Demontpx\UtilBundle\Entity;

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
