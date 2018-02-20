<?php

namespace Demontpx\UtilBundle\Test;

use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * @copyright 2018 Bert Hekman
 */
class PhpUnitBootstrapperTest extends TestCase
{
    /** @var KernelInterface */
    private $kernel;

    protected function setUp()
    {
        $this->kernel = $this->createMockKernel();
        $this->kernel->expects($this->any())->method('boot');
    }

    public function testGetInstance()
    {
        $this->expectException(\LogicException::class);
        $this->expectExceptionMessage('No instance of PhpUnitBootstrapper has been created');

        PhpUnitBootstrapper::getInstance();
    }

    public function testCreateGetInstance()
    {
        $bootstrapper = new PhpUnitBootstrapper($this->kernel);

        $this->assertSame($bootstrapper, PhpUnitBootstrapper::getInstance());
        $this->assertSame($this->kernel, $bootstrapper->getKernel());
        $this->assertSame($this->kernel, $bootstrapper->getApplication()->getKernel());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|KernelInterface
     */
    private function createMockKernel()
    {
        return $this->createMock(KernelInterface::class);
    }

}
