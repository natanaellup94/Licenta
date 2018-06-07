<?php

namespace FeedbackBundle\Admin;

use AdminIntegrationBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;

class GoalAdmin extends Admin
{
    /**
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['list', 'export']);
    }

    /**
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('title')
            ->add('user')
            ->add('progress', null, [
                'template' => 'FeedbackBundle:Admin\Goal:list_progress_field.html.twig'
            ])
            ->add('startDate', 'date')
            ->add('endDate', 'date');
    }

    /**
     * @param DatagridMapper $filter
     */
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('title')
            ->add('description')
            ->add('user');
    }
}