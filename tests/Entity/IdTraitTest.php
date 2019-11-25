<?php declare(strict_types=1);

namespace Demontpx\UtilBundle\Entity;

use PHPUnit\Framework\TestCase;

/**
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
