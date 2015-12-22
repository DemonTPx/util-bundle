<?php

namespace Demontpx\UtilBundle\Twig;

use Demontpx\UtilBundle\Intl\SimpleDateFormatter;

/**
 * Class SimpleDateFormatterExtensionTest
 *
 * @author    Bert Hekman <demontpx@gmail.com>
 * @copyright 2015 Bert Hekman
 */
class SimpleDateFormatterExtensionTest extends \PHPUnit_Framework_TestCase 
{
    /** @var SimpleDateFormatterExtension */
    private $extension;

    /** @var \PHPUnit_Framework_MockObject_MockObject|SimpleDateFormatter */
    private $formatter;

    protected function setUp()
    {
        $this->formatter = $this->createMockFormatter();
        $this->extension = new SimpleDateFormatterExtension($this->formatter);
    }

    /**
     * @param string $type
     * @param string $typeId
     *
     * @dataProvider getFormats
     */
    public function testDate($type, $typeId)
    {
        $date = '22-12-2015 00:47:47';
        $formattedDate = 'Dec 22, 2015';

        $this->formatter->expects($this->once())
            ->method('date')
            ->with($date, $typeId)
            ->willReturn($formattedDate);

        $result = $this->extension->date($date, $type);
        $this->assertSame($formattedDate, $result);
    }

    /**
     * @param string $type
     * @param string $typeId
     *
     * @dataProvider getFormats
     */
    public function testTime($type, $typeId)
    {
        $date = '22-12-2015 00:47:47';
        $formattedTime = 'Dec 22, 2015';

        $this->formatter->expects($this->once())
            ->method('time')
            ->with($date, $typeId)
            ->willReturn($formattedTime);

        $result = $this->extension->time($date, $type);
        $this->assertSame($formattedTime, $result);
    }

    public function getFormats()
    {
        return [
            ['full', SimpleDateFormatter::FULL],
            [SimpleDateFormatter::FULL, SimpleDateFormatter::FULL],
            ['long', SimpleDateFormatter::LONG],
            ['medium', SimpleDateFormatter::MEDIUM],
            ['short', SimpleDateFormatter::SHORT],
            ['none', SimpleDateFormatter::NONE],
        ];
    }

    public function testIncorrectType()
    {
        $this->setExpectedException(\InvalidArgumentException::class);

        $this->extension->date('now', 'invalid');
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|SimpleDateFormatter
     */
    public function createMockFormatter()
    {
        return $this->getMock(SimpleDateFormatter::class);
    }
}