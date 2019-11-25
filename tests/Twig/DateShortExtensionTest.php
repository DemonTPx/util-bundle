<?php declare(strict_types=1);

namespace Demontpx\UtilBundle\Twig;

use Demontpx\UtilBundle\Intl\SimpleDateFormatter;
use PHPUnit\Framework\TestCase;
use Twig\TwigFilter;

/**
 * @copyright 2014 Bert Hekman
 */
class DateShortExtensionTest extends TestCase
{
    /** @var SimpleDateFormatter */
    private $formatter;
    /** @var DateShortExtension */
    private $extension;

    protected function setUp(): void
    {
        $this->formatter = new SimpleDateFormatter('en');
        $this->extension = new DateShortExtension($this->formatter);
    }

    /**
     * @dataProvider getDateShortData
     */
    public function testDateShort(string $expected, \DateTime $date)
    {
        $this->assertEquals($expected, $this->extension->dateShort($date));
    }

    public function getDateShortData()
    {
        $dayMonthData = ['Jan 1', new \DateTime('january 1')];
        if (date('m-d') == '01-01') {
            $dayMonthData = ['Jan 2', new \DateTime('january 2')];
        }

        return [
            ['9:59 PM', new \DateTime('21:59')],
            ['12:01 AM', new \DateTime('0:01')],
            $dayMonthData,
            ['9/23/13', new \DateTime('2013-09-23')],
        ];
    }

    /**
     * @dataProvider getDateShortHoverData
     */
    public function testDateShortHover(string $expected, \DateTime $date)
    {
        $this->assertStringStartsWith('<span title="' . $expected . '">', $this->extension->dateShortHover($date));
    }

    public function getDateShortHoverData()
    {
        return [
            ['Sunday, November 9, 2014, 7:58 PM', new \DateTime('2014-11-09 19:58:20')],
        ];
    }

    public function testGetFilters()
    {
        /** @var TwigFilter[] $filterList */
        $filterList = $this->extension->getFilters();

        $this->assertEquals('date_short', $filterList[0]->getName());
        $this->assertEquals([$this->extension, 'dateShort'], $filterList[0]->getCallable());

        $this->assertEquals('date_short_hover', $filterList[1]->getName());
        $this->assertEquals([$this->extension, 'dateShortHover'], $filterList[1]->getCallable());
    }
}

