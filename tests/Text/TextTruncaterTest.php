<?php

namespace Demontpx\UtilBundle\Text;

use PHPUnit\Framework\TestCase;

/**
 * Class TextTruncaterTest
 *
 * @author    Bert Hekman <demontpx@gmail.com>
 * @copyright 2015 Bert Hekman
 */
class TextTruncaterTest extends TestCase
{
    /** @var TextTruncater */
    private $truncater;

    protected function setUp()
    {
        $this->truncater = new TextTruncater('UTF-8');
    }

    /**
     * @param string $expectedResult
     * @param string $value
     * @param int    $length
     * @param bool   $preserve
     * @param string $separator
     *
     * @dataProvider getTestData
     */
    public function test($expectedResult, $value, $length, $preserve, $separator)
    {
        $result = $this->truncater->truncate($value, $length, $preserve, $separator);

        $this->assertSame($expectedResult, $result);
    }

    public function getTestData()
    {
        return [
            ['cheese burger steak', 'cheese burger steak', 20, false, '...'],
            ['cheese bur...', 'cheese burger steak', 10, false, '...'],
            ['cheese burger...', 'cheese burger steak', 10, true, '...'],
            ['cheese burger-- read more!', 'cheese burger steak', 10, true, '-- read more!'],
            ['€€!', '€€€€€', 2, false, '!'],
        ];
    }
}
