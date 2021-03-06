<?php declare(strict_types=1);

namespace Demontpx\UtilBundle\DependencyInjection\Compiler;

use Demontpx\UtilBundle\Slug\SluggableManager;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * @copyright 2015 Bert Hekman
 */
class RegisterSluggableConfigurationCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $manager = $container->getDefinition(SluggableManager::class);

        $serviceIdList = $container->findTaggedServiceIds('demontpx_util.sluggable_configuration');
        foreach (array_keys($serviceIdList) as $id) {
            $manager->addMethodCall('register', [new Reference($id)]);
        }
    }
}
