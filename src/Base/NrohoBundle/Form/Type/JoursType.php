<?php

namespace Base\NrohoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class JoursType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('dim', 'checkbox', array(
                                        'required' => false,
                                        'label' => 'dimanche',
                                        'attr'   => array('class' => 'garlabo')
                                    )
            )
            ->add('lun', 'checkbox', array(
                                        'required' => false,
                                        'label' => 'lundi',
                                        'attr'   => array('class' => 'garlabo')
                                    )
            )
            ->add('mar', 'checkbox', array(
                                        'required' => false,
                                        'label' => 'mardi',
                                        'attr'   => array('class' => 'garlabo')
                                    )
            )
            ->add('mer', 'checkbox', array(
                                        'required' => false,
                                        'label' => 'mercredi',
                                        'attr'   => array('class' => 'garlabo')
                                    )
            )
            ->add('jeu', 'checkbox', array(
                                        'required' => false,
                                        'label' => 'jeudi',
                                        'attr'   => array('class' => 'garlabo')
                                    )
            )
            ->add('ven', 'checkbox', array(
                                        'required' => false,
                                        'label' => 'vendredi',
                                        'attr'   => array('class' => 'garlabo')
                                    )
            )
            ->add('sam', 'checkbox', array(
                                        'required' => false,
                                        'label' => 'samedi',
                                        'attr'   => array('class' => 'garlabo')
                                    )
            )
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Base\NrohoBundle\Entity\Jours'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'base_nrohobundle_jours';
    }
}
