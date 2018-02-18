<?php

namespace Demontpx\UtilBundle\Intl;

use PHPUnit\Framework\TestCase;

/**
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
     * @dataProvider getTestData
     */
    public function test(string $locale, $dateTime, string $format, string$expected)
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
