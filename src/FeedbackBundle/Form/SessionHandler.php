<?php

namespace FeedbackBundle\Form;

use FeedbackBundle\Entity\BaseQuestion;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SessionHandler extends AbstractType
{
    /**
     * Build form function.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('communicationAbilityAverage', 'hidden', array(
                'attr' => array(
                    'data-ability-field' => BaseQuestion::COMMUNICATION_ABILITY
                )
            ))
            ->add('knowledgeShareAbilityAverage', 'hidden', array(
                'attr' => array(
                    'data-ability-field' => BaseQuestion::KNOWLEDGE_SHARING_ABILITY
                )
            ))
            ->add('executionAbilityAverage', 'hidden', array(
                'attr' => array(
                    'data-ability-field' => BaseQuestion::EXECUTION_ABILITY
                )
            ))
            ->add('takingOverResponsabilityAbilityAverage', 'hidden', array(
                'attr' => array(
                    'data-ability-field' => BaseQuestion::TAKING_OVER_RESPONSABILITY_ABILITY
                )
            ))
            ->add('teamSpiritAbilityAverage', 'hidden', array(
                'attr' => array(
                    'data-ability-field' => BaseQuestion::TEAM_SPIRIT_ABILITY
                )
            ))
            ->add('openMindednessAbilityAverage', 'hidden', array(
                'attr' => array(
                    'data-ability-field' => BaseQuestion::OPEN_MINDEDNESS_ABILITY
                )
            ))
            ->add('goodPoints', 'textarea')
            ->add('improvePoints', 'textarea');
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'handle_goal';
    }

    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'FeedbackBundle\Entity\Session'
        ));
    }
}