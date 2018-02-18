<?php

namespace Demontpx\UtilBundle\Form;

use PHPUnit\Framework\TestCase;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * @copyright 2014 Bert Hekman
 */
class DeleteTypeTest extends TestCase
{
    public function testConfigureOptions()
    {
        $resolver = $this->createMockOptionsResolver();

        $resolver->expects($this->once())
            ->method('setDefaults')
            ->with(['method' => 'DELETE']);

        $type = new DeleteType();
        $type->configureOptions($resolver);
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|OptionsResolver
     */
    private function createMockOptionsResolver()
    {
        return $this->createMock(OptionsResolver::class);
    }
}

