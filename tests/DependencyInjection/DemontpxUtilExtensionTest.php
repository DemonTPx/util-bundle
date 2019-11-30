<?php declare(strict_types=1);

namespace Demontpx\UtilBundle\DependencyInjection;

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
            if (strpos($serviceId, '\\') !== -1) {
                $this->assertStringStartsWith('Demontpx\\UtilBundle\\', $serviceId);

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
     * @param string[] $tagList
     *
     * @dataProvider getServiceDefinedData
     */
    public function testServiceDefined(string $class, array $tagList)
    {
        $configs = [[]];
        $container = new ContainerBuilder();

        $extension = new DemontpxUtilExtension();
        $extension->load($configs, $container);

        $this->assertTrue($container->hasDefinition($class));

        $deleteFormTypeDefinition = $container->getDefinition($class);
        $this->assertEquals($tagList, array_keys($deleteFormTypeDefinition->getTags()));
    }

    public function getServiceDefinedData()
    {
        return [
            [DateShortExtension::class, ['twig.extension']],
            [SimpleDateFormatterExtension::class, ['twig.extension']],
        ];
    }
}

