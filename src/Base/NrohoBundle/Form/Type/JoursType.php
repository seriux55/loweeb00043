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
                                        'label' => 'Dimanche',
                                        'attr'   => array('class' => 'nosautligne')
                                    )
            )
            ->add('lun', 'checkbox', array(
                                        'required' => false,
                                        'label' => 'Lundi',
                                        'attr'   => array('class' => 'nosautligne')
                                    )
            )
            ->add('mar', 'checkbox', array(
                                        'required' => false,
                                        'label' => 'Mardi',
                                        'attr'   => array('class' => 'nosautligne')
                                    )
            )
            ->add('mer', 'checkbox', array(
                                        'required' => false,
                                        'label' => 'Mercredi',
                                        'attr'   => array('class' => 'nosautligne')
                                    )
            )
            ->add('jeu', 'checkbox', array(
                                        'required' => false,
                                        'label' => 'Jeudi',
                                        'attr'   => array('class' => 'nosautligne')
                                    )
            )
            ->add('ven', 'checkbox', array(
                                        'required' => false,
                                        'label' => 'Vendredi',
                                        'attr'   => array('class' => 'nosautligne')
                                    )
            )
            ->add('sam', 'checkbox', array(
                                        'required' => false,
                                        'label' => 'Samedi',
                                        'attr'   => array('class' => 'nosautligne')
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
