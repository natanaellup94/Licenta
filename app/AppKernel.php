<?php

use Symfony\Component\HttpKernel\Kernel;
use Symfony\Component\Config\Loader\LoaderInterface;

class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            new Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new Symfony\Bundle\TwigBundle\TwigBundle(),
            new Symfony\Bundle\MonologBundle\MonologBundle(),
            new Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),

            // Community bundles.
            new Sonata\CoreBundle\SonataCoreBundle(),
            new Sonata\CacheBundle\SonataCacheBundle(),
            new Sonata\UserBundle\SonataUserBundle(),
            new Knp\Bundle\MenuBundle\KnpMenuBundle(),
            new Sonata\BlockBundle\SonataBlockBundle(),
            new Sonata\DoctrineORMAdminBundle\SonataDoctrineORMAdminBundle(),
            new Sonata\AdminBundle\SonataAdminBundle(),
            new FOS\UserBundle\FOSUserBundle(),
            new Stof\DoctrineExtensionsBundle\StofDoctrineExtensionsBundle(),
            new Pix\SortableBehaviorBundle\PixSortableBehaviorBundle(),
            new Sonata\SeoBundle\SonataSeoBundle(),
            new Cocur\Slugify\Bridge\Symfony\CocurSlugifyBundle,
            new Boekkooi\Bundle\JqueryValidationBundle\BoekkooiJqueryValidationBundle(),
            new SimpleThings\EntityAudit\SimpleThingsEntityAuditBundle(),

            // Custom bundles.
            new AdminIntegrationBundle\AdminIntegrationBundle(),
            new FeedbackBundle\FeedbackBundle(),
            new UserBundle\UserBundle(),
        );

        if (in_array($this->getEnvironment(), array('dev', 'test'), true)) {
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
        }

        return $bundles;
    }

    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $loader->load($this->getRootDir().'/config/config_'.$this->getEnvironment().'.yml');
    }
}
