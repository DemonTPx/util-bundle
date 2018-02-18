<?php

namespace Demontpx\UtilBundle\DependencyInjection;

use Demontpx\UtilBundle\Form\DeleteType;
use Demontpx\UtilBundle\Twig\DateShortExtension;
use Demontpx\UtilBundle\Twig\SimpleDateFormatterExtension;
use PHPUnit\Framework\TestCase;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * @copyright 2014 Bert Hekman
 */
class DemontpxUtilExtensionTest extends TestCase
{
    public function testCorrectServiceNameRoots()
    {
        $configs = [[]];
        $container = new ContainerBuilder();

        $extension = new DemontpxUtilExtension();
        $extension->load($configs, $container);

        foreach (array_keys($container->getDefinitions()) as $serviceId) {
            if ($serviceId == 'service_container') {
                continue;
            }
            $this->assertStringStartsWith('demontpx_util.', $serviceId);
        }

        foreach (array_keys($container->getAliases()) as $serviceId) {
            if (strpos($serviceId, '\\') !== -1) {
                continue;
            }
            $this->assertStringStartsWith('demontpx_util.', $serviceId);
        }

        foreach (array_keys($container->getParameterBag()->all()) as $serviceId) {
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
        return [
            ['demontpx_util.form.type.delete', DeleteType::class, ['form.type']],
            ['demontpx_util.twig.extension.date_short', DateShortExtension::class, ['twig.extension']],
            ['demontpx_util.twig.extension.simple_date_formatter', SimpleDateFormatterExtension::class, ['twig.extension']],
        ];
    }
}

