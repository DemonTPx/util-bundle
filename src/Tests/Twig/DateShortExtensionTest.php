<?php

namespace Demontpx\UtilBundle\Tests\Twig;

use Demontpx\UtilBundle\Twig\DateShortExtension;

/**
 * Class DateShortExtensionTest
 *
 * @author    Bert Hekman <demontpx@gmail.com>
 * @copyright 2014 Bert Hekman
 */
class DateShortExtensionTest extends \PHPUnit_Framework_TestCase 
{
    /** @var DateShortExtension */
    private $extension;

    protected function setUp()
    {
        $this->extension = new DateShortExtension();
    }

    /**
     * @param string    $expected
     * @param \DateTime $date
     *
     * @dataProvider getDateShortData
     */
    public function testDateShort($expected, \DateTime $date)
    {
        $this->assertEquals($expected, $this->extension->dateShort($date));
    }

    public function getDateShortData()
    {
        $dayMonthData = array('1 jan.', new \DateTime('january 1'));
        if (date('m-d') == '01-01') {
            $dayMonthData = array('2 jan.', new \DateTime('january 2'));
        }

        return array(
            array('21:59', new \DateTime('21:59')),
            array('00:01', new \DateTime('0:01')),
            $dayMonthData,
            array('23-09-13', new \DateTime('2013-09-23')),
        );
    }

    /**
     * @param string    $expected
     * @param \DateTime $date
     *
     * @dataProvider getDateShortHoverData
     */
    public function testDateShortHover($expected, \DateTime $date)
    {
        $this->assertStringStartsWith('<span title="' . $expected . '">', $this->extension->dateShortHover($date));
    }

    public function getDateShortHoverData()
    {
        return array(
            array('Sun 9 November 2014, 19:58', new \DateTime('2014-11-09 19:58:20')),
        );
    }

    public function testGetName()
    {
        $this->assertEquals('date_short', $this->extension->getName());
    }

    public function testGetFilters()
    {
        /** @var \Twig_SimpleFilter[] $filterList */
        $filterList = $this->extension->getFilters();

        $this->assertEquals('date_short', $filterList[0]->getName());
        $this->assertEquals(array($this->extension, 'dateShort'), $filterList[0]->getCallable());

        $this->assertEquals('date_short_hover', $filterList[1]->getName());
        $this->assertEquals(array($this->extension, 'dateShortHover'), $filterList[1]->getCallable());
    }
}

