<?php

namespace Demontpx\UtilBundle\Tests\DependencyInjection;

use Demontpx\UtilBundle\DependencyInjection\DemontpxUtilExtension;
use Demontpx\UtilBundle\Form\DeleteType;
use Demontpx\UtilBundle\Twig\DateShortExtension;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class DemontpxUtilExtensionTest
 *
 * @author    Bert Hekman <demontpx@gmail.com>
 * @copyright 2014 Bert Hekman
 */
class DemontpxUtilExtensionTest extends \PHPUnit_Framework_TestCase 
{
    public function testCorrectServiceNameRoots()
    {
        $configs = [[]];
        $container = new ContainerBuilder();

        $extension = new DemontpxUtilExtension();
        $extension->load($configs, $container);

        foreach (array_keys($container->getDefinitions()) as $serviceId) {
            $this->assertStringStartsWith('demontpx_util.', $serviceId);
        }

        foreach (array_keys($container->getAliases()) as $serviceId) {
            $this->assertStringStartsWith('demontpx_util.', $serviceId);
        }
    }

    /**
     * @param string   $name
     * @param string   $class
     * @param string[] $tagList
     *
     * @dataProvider getServiceDefinedData
     */
    public function testServiceDefined($name, $class, $tagList)
    {
        $configs = [[]];
        $container = new ContainerBuilder();

        $extension = new DemontpxUtilExtension();
        $extension->load($configs, $container);

        $this->assertTrue($container->hasDefinition($name));

        $deleteFormTypeDefinition = $container->getDefinition($name);
        $this->assertEquals($class, $deleteFormTypeDefinition->getClass());
        $this->assertEquals($tagList, array_keys($deleteFormTypeDefinition->getTags()));
    }

    public function getServiceDefinedData()
    {
        return array(
            array('demontpx_util.form.type.delete', DeleteType::class, array('form.type')),
            array('demontpx_util.twig.date_short_extension', DateShortExtension::class, array('twig.extension')),
        );
    }
}

