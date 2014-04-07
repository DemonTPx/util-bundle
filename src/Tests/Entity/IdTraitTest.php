<?php

namespace DemonTPx\UtilBundle\Tests\Entity;

/**
 * Class IdTraitTest
 *
 * @package   DemonTPx\UtilBundle\Tests\Entity
 * @author    Bert Hekman <demontpx@gmail.com>
 * @copyright 2014 Bert Hekman
 */
class IdTraitTest extends \PHPUnit_Framework_TestCase
{
    public function test()
    {
        $trait = new TraitImpl();

        $trait->setId(123);
        $this->assertEquals(123, $trait->getId());
    }
}
