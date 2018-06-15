<?php

namespace FeedbackBundle\Form;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;

class RecognitionHandler extends AbstractType
{
    /**
     * @var TokenStorage
     */
    private $tokenStorage;

    /**
     * RecognitionHandler constructor.
     * @param TokenStorage $tokenStorage
     */
    public function __construct(TokenStorage $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * Build form function.
     *
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $currentUser = $this->tokenStorage->getToken()->getUser();

        $builder
            ->add('description', 'textarea')
            ->add('to', 'entity', array(
                'class' => 'UserBundle\Entity\User',
                'query_builder' => function (EntityRepository $er) use ($currentUser){
                    $qb = $er->createQueryBuilder('u')
                            ->where('u.id <> :currentUserId')
                            ->orderBy('u.id');
                    $qb->setParameter('currentUserId', $currentUser->getId());
                    return $qb;
                },
                'choice_label'  => 'username'
            ))
            ->add('type', 'entity', array(
                'class' => 'FeedbackBundle\Entity\RecognitionType',
                'query_builder' => function (EntityRepository $er){
                    return $er->createQueryBuilder('t')
                        ->orderBy('t.type');
                },
                'choice_label'  => 'type'
            ));
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
            'data_class' => 'FeedbackBundle\Entity\Recognition'
        ));
    }
}