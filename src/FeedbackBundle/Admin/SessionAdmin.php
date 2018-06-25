<?php

namespace FeedbackBundle\Admin;

use AdminIntegrationBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class SessionAdmin extends Admin
{

    /**
     * Configure list fields.
     *
     * @param ListMapper $list
     */
    public function configureListFields(ListMapper $list)
    {
        $list
            ->add('to')
            ->add('from')
            ->add('added')
            ->add('status', null, array('template' => 'FeedbackBundle:Admin\Session:status_field.html.twig'));
    }

    /**
     * Configure form fields.
     *
     * @param FormMapper $form
     */
    public function configureFormFields(FormMapper $form)
    {
        $form
            ->add('to')
            ->add('from');
    }
}