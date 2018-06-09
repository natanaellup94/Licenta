<?php
/**
 * Created by PhpStorm.
 * User: Nati
 * Date: 6/9/2018
 * Time: 2:57 PM
 */

namespace FeedbackBundle\Admin;


use AdminIntegrationBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;

class RecognitionTypeAdmin extends Admin
{

    public function configureRoutes(RouteCollection $collection)
    {
        $collection->remove('history');
    }

    /**
     * @param FormMapper $form
     */
    protected function configureFormFields(FormMapper $form)
    {
        $form
            ->with('Details', array('class' => 'col-md-6'))
            ->add('type')
            ->end();
    }

    /**
     * @param ListMapper $list
     */
    protected function configureListFields(ListMapper $list)
    {
        $list
            ->addIdentifier('type');
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