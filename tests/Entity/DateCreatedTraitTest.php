<?php

namespace Demontpx\UtilBundle\Entity;

/**
 * Class DateCreatedTraitTest
 *
 * @package   Demontpx\UtilBundle\Tests\Entity
 * @author    Bert Hekman <demontpx@gmail.com>
 * @copyright 2014 Bert Hekman
 */
class DateCreatedTraitTest extends \PHPUnit_Framework_TestCase
{
    public function testGetterSetter()
    {
        $trait = new TraitImpl();

        $date = new \DateTime('2014-04-07 23:03:00');
        $trait->setDateCreated($date);
        $this->assertEquals($date, $trait->getDateCreated());
    }

    public function testSetDateCreatedNow()
    {
        $trait = new TraitImpl();

        $trait->setDateCreatedNow();
        $this->assertInstanceOf(\DateTime::class, $trait->getDateCreated());
    }
}