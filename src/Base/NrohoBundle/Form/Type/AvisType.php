<?php

namespace Base\NrohoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AvisType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('avis', 'textarea', array(
                                        'attr' => array(
                                                    'cols' => '92', 
                                                    'rows' => '5'
                                                ),
                                    )
            )
            ->add('emo', 'hidden')
            ->add('ip', 'hidden')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Base\NrohoBundle\Entity\Avis',
            'intention'  => 'task_form',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'base_nrohobundle_avis';
    }
}
