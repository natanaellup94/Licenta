<?php

namespace FeedbackBundle\Admin;

use AdminIntegrationBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class RecognitionAdmin extends Admin
{
    protected $datagridValues = array(
        '_sort_order' => 'DESC', // reverse order (default = 'ASC')
        '_sort_by' => 'added'  // name of the ordered field
    );

    /**
     * @param RouteCollection $collection
     */
    public function configureRoutes(RouteCollection $collection)
    {
        $collection->clearExcept(array('list', 'export'));
    }

    /**
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->add('description')
            ->add('type')
            ->add('from')
            ->add('to')
            ->add('added');
    }

    /**
     * @param DatagridMapper $filter
     */
    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter
            ->add('type');
    }
}