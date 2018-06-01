<?php

namespace UserBundle\Admin;

use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\UserBundle\Admin\Entity\GroupAdmin as BaseGroupAdmin;
use Sonata\AdminBundle\Form\FormMapper;

class GroupAdmin extends BaseGroupAdmin
{
    /**
     * {@inheritdoc}
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove('history');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->with('General', array('class' => 'col-md-6'))
                ->add('name')
            ->end()

            ->with('Roles', array('class' => 'col-md-6'))
                ->add('roles', 'sonata_security_roles', array(
                    'expanded' => true,
                    'multiple' => true,
                    'required' => true,
                ))
            ->end()
        ;
    }
}
