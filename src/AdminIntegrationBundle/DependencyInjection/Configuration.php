<?php

namespace AdminIntegrationBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        
        $rootNode = $treeBuilder->root('admin_integration');
        // Register the 'dashboard_row_template' and the 'add_block_row_template' options.
        // These options will be used to configure the generic templates for the rows
        // of the dashboard block and of the add block. The templates can be overriden
        // on an entity basis, as every row represents basically an entity type.
        $rootNode
            ->children()
                ->scalarNode('dashboard_row_template')
                    ->defaultValue('AdminIntegrationBundle:Dashboard:_row.html.twig')
                    ->cannotBeEmpty()
                ->end()
                ->scalarNode('add_block_row_template')
                    ->defaultValue('AdminIntegrationBundle:Core\add_block:_row.html.twig')
                    ->cannotBeEmpty()
                ->end()
            ->end();

        return $treeBuilder;
    }
}
