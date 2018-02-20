<?php

namespace Demontpx\UtilBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * @copyright 2014 Bert Hekman
 */
class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('demontpx_util');

        $rootNode->children()
            ->booleanNode('testing')->defaultFalse()->end()
        ->end();

        return $treeBuilder;
    }
}
