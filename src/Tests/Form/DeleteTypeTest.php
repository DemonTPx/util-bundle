<?php

namespace Demontpx\UtilBundle\Tests\Form;

use Demontpx\UtilBundle\Form\DeleteType;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class DeleteTypeTest
 *
 * @author    Bert Hekman <demontpx@gmail.com>
 * @copyright 2014 Bert Hekman
 */
class DeleteTypeTest extends \PHPUnit_Framework_TestCase 
{
    public function testSetDefaultOptions()
    {
        $resolver = $this->createMockOptionsResolver();

        $resolver->expects($this->once())
            ->method('setDefaults')
            ->with(array('method' => 'DELETE'));

        $type = new DeleteType();
        $type->setDefaultOptions($resolver);
    }

    public function testGetName()
    {
        $type = new DeleteType();
        $this->assertEquals('delete', $type->getName());
    }

    /**
     * @return \PHPUnit_Framework_MockObject_MockObject|OptionsResolverInterface
     */
    private function createMockOptionsResolver()
    {
        return $this->getMock(OptionsResolverInterface::class);
    }
}

