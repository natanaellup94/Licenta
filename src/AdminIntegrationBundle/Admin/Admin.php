<?php

namespace AdminIntegrationBundle\Admin;

use Sonata\AdminBundle\Admin\Admin as SonataAdmin;
use Sonata\AdminBundle\Route\RouteCollection;

abstract class Admin extends SonataAdmin
{
    /**
     * {@inheritdoc}
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        parent::configureRoutes($collection);
    }


    /**
     * Check if the request is ajax
     * @return bool
     */
    protected function isAjaxRequest()
    {
        // skip the check if is a cli request
        if (PHP_SAPI == 'cli') {
            return false;
        }

        // check if ajax request
        if ($this->getConfigurationPool()->getContainer()->get('request')->isXmlHttpRequest()) {
            return true;
        }

        return false;
    }
}
