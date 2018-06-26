<?php
/**
 * Created by PhpStorm.
 * User: Nati
 * Date: 6/26/2018
 * Time: 11:06 PM
 */

namespace FeedbackBundle\Admin;

use AdminIntegrationBundle\Admin\Admin;
use FeedbackBundle\Entity\BaseQuestion;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;

class BaseQuestionAdmin extends Admin
{
    protected $parentAssociationMapping = 'group';

    /**
     * @param ListMapper $list
     */
    public function configureListFields(ListMapper $list)
    {
        $list
            ->add('text')
            ->add('abilityTypeLabel');
    }

    /**
     * @param FormMapper $form
     */
    public function configureFormFields(FormMapper $form)
    {
        $form
            ->add('text')
            ->add('abilityType', 'choice', array(
                'label' => 'Ability',
                'choices' => BaseQuestion::getAbilityLabels()
            ));
    }
}