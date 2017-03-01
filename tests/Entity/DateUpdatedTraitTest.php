<?php

namespace Demontpx\UtilBundle\Entity;

use PHPUnit\Framework\TestCase;

/**
 * Class DateUpdatedTraitTest
 *
 * @author    Bert Hekman <demontpx@gmail.com>
 * @copyright 2014 Bert Hekman
 */
class DateUpdatedTraitTest extends TestCase
{
    public function testGetterSetter()
    {
        $trait = new TraitImpl();

        $date = new \DateTime('2014-04-07 23:03:00');
        $trait->setDateUpdated($date);
        $this->assertEquals($date, $trait->getDateUpdated());
    }

    public function testSetDateUpdatedNow()
    {
        $trait = new TraitImpl();

        $trait->setDateUpdatedNow();
        $this->assertInstanceOf(\DateTime::class, $trait->getDateUpdated());
    }
}
