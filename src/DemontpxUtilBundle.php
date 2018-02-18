<?php

namespace Demontpx\UtilBundle;

use Demontpx\UtilBundle\DependencyInjection\Compiler\RegisterSluggableConfigurationCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

/**
 * @copyright 2014 Bert Hekman
 */
class DemontpxUtilBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new RegisterSluggableConfigurationCompilerPass());
    }
}
