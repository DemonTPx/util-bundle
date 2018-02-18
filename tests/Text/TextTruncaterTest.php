<?php

namespace Demontpx\UtilBundle\Text;

use PHPUnit\Framework\TestCase;

/**
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
     * @dataProvider getTestData
     */
    public function test(string $expectedResult, string $value, int $length, bool $preserve, string $separator)
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
