<?php

namespace  TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TestForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('test', 'zitec_autocomplete', array(
                    'data_resolver' => 'test_autocomplete',
                    'delay' => 250,
                    'allow_clear' => true,
                    'placeholder' => 'placeholder_campaign_list_city'
                )
            )
            ->add('tests', 'entity', array(
                'class' => 'TestBundle:Test',
                'choice_label' => 'name'
            ))
            ->add('submit', 'submit', ['label' => 'Send']);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'attr' => ['class' => 'ajaxForm']
        ));
    }

    public function getName()
    {
        return 'test';
    }
}