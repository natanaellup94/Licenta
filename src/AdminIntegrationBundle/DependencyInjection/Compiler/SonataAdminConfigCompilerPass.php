<?php

namespace AdminIntegrationBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Container compiler pass used to add a method call which will set the dashboard block and the add block row
 * default templates on every existent admin service.
 */
class SonataAdminConfigCompilerPass implements CompilerPassInterface
{
    /**
     * Checks if the given template has already been configured.
     * 
     * @param string $templateKey
     * @param array $methodCalls
     * 
     * @return boolean
     */
    protected function findTemplateConfiguration($templateKey, array $methodCalls)
    {
        foreach ($methodCalls as $methodCall) {
            if (($methodCall[0] == 'setTemplate' && $methodCall[1][0] == $templateKey) 
                || ($methodCall[0] == 'setTemplates' && array_key_exists($templateKey, $methodCall[1][0]))
            ) {
                return true;
            }
        }
        
        return false;
    }
    
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        // The method call definitions for setting the template options.
        $methodCallsDefinitions = array(
            'dashboard_row' => array(
                'setTemplate',
                array(
                    'dashboard_row',
                    $container->getParameter('admin_integration.dashboard_row_template'),
                )
            ),
            'add_block_row' => array(
                'setTemplate',
                array(
                    'add_block_row',
                    $container->getParameter('admin_integration.add_block_row_template'),
                )
            )
        );
        
        $adminManagersIds = $container->findTaggedServiceIds('sonata.admin');
        foreach (array_keys($adminManagersIds) as $id) {
            $adminManager = $container->getDefinition($id);
            
            // We will be careful not to overwrite the already defined configuration, as we only want
            // to set a default value.
            $methodCalls = $adminManager->getMethodCalls();
            foreach ($methodCallsDefinitions as $templateKey => $methodCallDefinition) {
                if (!$this->findTemplateConfiguration($templateKey, $methodCalls)) {
                    $methodCalls[] = $methodCallDefinition;
                }
            }

            $adminManager->setMethodCalls($methodCalls);
        }
    }
}
