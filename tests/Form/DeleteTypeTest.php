<?php

namespace Demontpx\UtilBundle\Form;

use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Class DeleteTypeTest
 *
 * @author    Bert Hekman <demontpx@gmail.com>
 * @copyright 2014 Bert Hekman
 */
class DeleteTypeTest extends \PHPUnit_Framework_TestCase 
{
    public function testConfigureOptions()
    {
        $resolver = $this->createMockOptionsResolver();

        $resolver->expects($this->once())
            ->method('setDefaults')
            ->with(array('method' => 'DELETE'));

        $type = new DeleteType();
        $type->configureOptions($resolver);
    }

    public function testGetName()
    {
        $type = new DeleteType();
        $this->assertEquals('delete', $type->getName());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|OptionsResolver
     */
    private function createMockOptionsResolver()
    {
        return $this->getMock(OptionsResolver::class);
    }
}

