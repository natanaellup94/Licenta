<?php

namespace AdminIntegrationBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use AdminIntegrationBundle\DependencyInjection\Compiler\SonataAdminConfigCompilerPass;

/**
 * The bundle class.
 */
class AdminIntegrationBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        parent::build($container);
        
        $container->addCompilerPass(new SonataAdminConfigCompilerPass());
    }
}
