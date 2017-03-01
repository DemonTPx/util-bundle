<?php

namespace Demontpx\UtilBundle\Entity;

use PHPUnit\Framework\TestCase;

/**
 * Class IdTraitTest
 *
 * @author    Bert Hekman <demontpx@gmail.com>
 * @copyright 2014 Bert Hekman
 */
class IdTraitTest extends TestCase
{
    public function test()
    {
        $trait = new TraitImpl();

        $trait->setId(123);
        $this->assertEquals(123, $trait->getId());
    }
}
