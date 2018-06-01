<?php

namespace UserBundle\Admin;

use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Route\RouteCollection;
use Sonata\AdminBundle\Show\ShowMapper;
use Sonata\UserBundle\Admin\Entity\UserAdmin as BaseUserAdmin;
use Symfony\Component\Intl\Intl;

class UserAdmin extends BaseUserAdmin
{
    /**
     * {@inheritdoc}
     */
    protected function configureRoutes(RouteCollection $collection)
    {
        $collection
            ->remove('history');
    }

    /**
     * @var string
     */
    const GENDER_FEMALE = 'f';

    /**
     * @var string
     */
    const GENDER_MALE = 'm';

    /**
     * @var string
     */
    const GENDER_FEMALE_LABEL = 'Female';

    /**
     * @var string
     */
    const GENDER_MALE_LABEL = 'Male';

    /**
     * Array with gender types label.
     *
     * @array
     */
    const GENDER_TYPES_LABEL = array(
        self::GENDER_FEMALE => self::GENDER_FEMALE_LABEL,
        self::GENDER_MALE   => self::GENDER_MALE_LABEL
    );

    public function configure()
    {
        $this->setTemplate('edit', 'UserBundle:Admin:User/edit.html.twig');
    }

    /**
     * {@inheritdoc}
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->with('General')
            ->add('username')
            ->add('email')
            ->end()
            ->with('Groups')
            ->add('groups')
            ->end()
            ->with('Profile')
            ->add('dateOfBirth')
            ->add('firstname')
            ->add('lastname')
            ->add('website')
            ->add('biography')
            ->add(
                'gender',
                'choice',
                array('choices' => self::GENDER_TYPES_LABEL, 'translation_domain' => $this->getTranslationDomain())
            )
            ->add('locale', 'choice', array('choices' => Intl::getLocaleBundle()->getLocaleNames()))
            ->add('timezone')
            ->add('phone')
            ->end();
    }


    /**
     * {@inheritdoc}
     */
    public function getExportFields()
    {
        $fields = array(
            'Username'      => 'username',
            'Email'         => 'email',
            'Phone'         => 'phone',
            'First Name'    => 'firstName',
            'Last Name'     => 'lastName',
            'Date of birth' => 'dateOfBirth',
            'Gender'        => 'gender',
            'Biography'     => 'biography',
            'Website'       => 'website',
            'Locale'        => 'locale',
            'Timezone'      => 'timezone'
        );

        return $fields;
    }

    /**
     * {@inheritdoc}
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        // define group zoning
        $formMapper
            ->tab('User')
            ->with('Profile', array('class' => 'col-md-6'))->end()
            ->with('General', array('class' => 'col-md-6'))->end()
            ->end()
            ->tab('Security')
            ->with('Status', array('class' => 'col-md-6 user-check-box'))->end()
            ->with('Security', array('class' => 'col-md-6'))->end()
            ->end();

        $now = new \DateTime();
        $formMapper
            ->tab('User')
            ->with('General')
            ->add('username')
            ->add('email')
            ->add(
                'plainPassword',
                'text',
                array(
                    'required' => (!$this->getSubject() || is_null($this->getSubject()->getId())),
                    'help'     => 'Password does not meet the requirements.'
                )
            )
            ->end()
            ->with('Profile')
            ->add(
                'dateOfBirth',
                'sonata_type_date_picker',
                array(
                    'years'       => range(1900, $now->format('Y')),
                    'dp_min_date' => '1-1-1900',
                    'dp_max_date' => $now->format('c'),
                    'required'    => false,
                )
            )
            ->add('firstname', null, array('required' => false))
            ->add('lastname', null, array('required' => false))
            ->add('website', 'url', array('required' => false))
            ->add('biography', 'text', array('required' => false))
            ->add(
                'gender',
                'choice',
                array(
                    'required'           => true,
                    'choices'            => self::GENDER_TYPES_LABEL,
                    'translation_domain' => $this->getTranslationDomain(),
                    'placeholder'        => 'Please select a gender'
                )
            )
            ->add('locale', 'locale', array('required' => false))
            ->add('timezone', 'timezone', array('required' => false))
            ->add('phone')
            ->end()
            ->end();

        if ($this->getSubject() && !$this->getSubject()->hasRole('ROLE_SUPER_ADMIN')) {
            $formMapper
                ->tab('Security')
                ->with('Status')
                ->add('locked', null, array('required' => false))
                ->add('expired', null, array('required' => false))
                ->add('enabled', null, array('required' => false))
                ->add('credentialsExpired', null, array('required' => false))
                ->end()
                ->with('Security')
                ->add(
                    'groups',
                    'sonata_type_model',
                    array(
                        'required' => true,
                        'multiple' => true,
                        'btn_add'  => false
                    )
                )
                ->add(
                    'realRoles',
                    'sonata_security_roles',
                    array(
                        'label'    => 'form.label_roles',
                        'expanded' => true,
                        'multiple' => true,
                        'required' => false,
                    )
                )
                ->end()
                ->end();
        }
    }
}
