<?php

namespace FeedbackBundle\Form;

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
            ->add('communicationAbilityAverage', 'hidden')
            ->add('knowledgeShareAbilityAverage', 'hidden')
            ->add('executionAbilityAverage', 'hidden')
            ->add('takingOverResponsabilityAbilityAverage', 'hidden')
            ->add('teamSpiritAbilityAverage', 'hidden')
            ->add('openMindednessAbilityAverage', 'hidden')
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