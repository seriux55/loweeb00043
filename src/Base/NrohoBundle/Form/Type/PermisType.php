<?php

namespace Base\NrohoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PermisType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('file', 'file', array('label'=>'Envoyer-nous votre permis!'))
            ->add('Envoyer', 'submit', array(
                'attr' => array('class' => 'publier'),
            ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Base\NrohoBundle\Entity\Permis'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'base_nrohobundle_permis';
    }
}
