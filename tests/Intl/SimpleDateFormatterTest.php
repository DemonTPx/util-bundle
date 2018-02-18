<?php

namespace Demontpx\UtilBundle\Intl;

use PHPUnit\Framework\TestCase;

/**
 * Class SimpleDateFormatterTest
 *
 * @author    Bert Hekman <demontpx@gmail.com>
 * @copyright 2015 Bert Hekman
 */
class SimpleDateFormatterTest extends TestCase
{
    public function setUp()
    {
        if ( ! extension_loaded('intl')) {
            $this->markTestSkipped('intl extension needs to be enabled');
        }
    }

    /**
     * @param string $locale
     * @param mixed  $dateTime
     * @param string $format
     * @param string $expected
     *
     * @dataProvider getTestData
     */
    public function test($locale, $dateTime, $format, $expected)
    {
        $formatter = new SimpleDateFormatter($locale);

        $this->assertEquals($expected, $formatter->format($dateTime, $format));
    }

    public function getTestData()
    {
        return [
            ['nl', '2015-12-22', 'cccc', 'dinsdag'],
            ['en', '2015-12-22', 'cccc', 'Tuesday'],
            ['fr', '2015-12-22', 'MMMM', 'décembre'],
        ];
    }
}
