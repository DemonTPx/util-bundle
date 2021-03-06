<?php declare(strict_types=1);

namespace Demontpx\UtilBundle\Twig;

use Demontpx\UtilBundle\Intl\SimpleDateFormatter;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;

/**
 * @copyright 2015 Bert Hekman
 */
class SimpleDateFormatterExtensionTest extends TestCase
{
    private SimpleDateFormatterExtension $extension;
    /** @var MockObject|SimpleDateFormatter */
    private $formatter;

    protected function setUp(): void
    {
        $this->formatter = $this->createMockFormatter();
        $this->extension = new SimpleDateFormatterExtension($this->formatter);
    }

    /**
     * @dataProvider getFormats
     */
    public function testDate($type, int $typeId)
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
     * @dataProvider getFormats
     */
    public function testTime($type, int $typeId)
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
        $this->expectException(\InvalidArgumentException::class);

        $this->extension->date('now', 'invalid');
    }

    /**
     * @return MockObject|SimpleDateFormatter
     */
    public function createMockFormatter()
    {
        return $this->createMock(SimpleDateFormatter::class);
    }
}
