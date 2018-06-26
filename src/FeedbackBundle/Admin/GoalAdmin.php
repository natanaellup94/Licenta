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
     * Remove following routes: create, edit and remove.
     *
     * @param RouteCollection $collection
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(['list']);
    }

    /**
     * Configure list mapper fields. Show information for each goal object.
     * For progress field create a custom template. This template show progress bar information.
     *
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->add('title')
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