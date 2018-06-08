<?php

namespace FeedbackBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class GoalHandler extends AbstractType
{
    /**
     * Build form function.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $currentGoal = $options['data'];

        $builder
            ->add('title')
            ->add('description', 'textarea')
            ->add('startDate', 'text')
            ->add('endDate', 'text');

        if(!is_null($currentGoal->getId())){
            $builder->add('progress');
        }

        $builder->get('startDate')->addModelTransformer($this->getDateTimeCallbackTransformer());
        $builder->get('endDate')->addModelTransformer($this->getDateTimeCallbackTransformer());

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
            'data_class' => 'FeedbackBundle\Entity\Goal'
        ));
    }

    /**
     * Get data transformer for date fields.
     *
     * @return CallbackTransformer
     */
    private function getDateTimeCallbackTransformer()
    {
        return new CallbackTransformer(
            function ($date){
                if($date){
                    return $date->format('F j, Y');
                }
            },
            function($stringDate){
                if($stringDate){
                    return new \DateTime($stringDate);
                }
            });
    }
}