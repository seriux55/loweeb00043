<?php

namespace Base\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class RegistrationFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // Ajoutez vos champs ici, revoilà notre champ *location* :
        $builder
            ->remove('username')
            
            
            ->add('gender', 'choice', array(
                'choices' => array('1' => 'Homme', '0' => 'Femme'),
                'expanded' => true,
                'multiple' => false,
            ))
            //->add('gender', 'text')
            ->add('firstname', 'text')
            ->add('secondename', 'text')
            ->add('born', 'text')
            ->add('phone', 'text')
        ;
        
    }
    
    public function getParent()
    {
        return 'fos_user_registration';
    }
    
    public function getName()
    {
        return 'base_user_registration';
    }
}