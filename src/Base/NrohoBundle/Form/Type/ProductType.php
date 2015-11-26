<?php

namespace Base\NrohoBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ProductType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $wilaya = array(
            '01 - Adrar'                => '01 - Adrar', 
            '02 - Chlef'                => '02 - Chlef', 
            '03 - Laghouat'             => '03 - Laghouat', 
            '04 - Oum El Bouaghi'       => '04 - Oum El Bouaghi', 
            '05 - Batna'                => '05 - Batna',
            '06 - Bejaia'               => '06 - Bejaia', 
            '07 - Biskra'               => '07 - Biskra', 
            '08 - Bechar'               => '08 - Bechar', 
            '09 - Blida'                => '09 - Blida', 
            '10 - Bouira'               => '10 - Bouira', 
            '11 - Tamanrasset'          => '11 - Tamanrasset',
            '12 - Tebessa'              => '12 - Tebessa', 
            '13 - Tlemcen'              => '13 - Tlemcen', 
            '14 - Tiaret'               => '14 - Tiaret', 
            '15 - Tizi Ouzou'           => '15 - Tizi Ouzou', 
            '16 - Alger'                => '16 - Alger', 
            '17 - Djelfa'               => '17 - Djelfa',
            '18 - Jijel'                => '18 - Jijel', 
            '19 - Setif'                => '19 - Setif', 
            '20 - Saida'                => '20 - Saida', 
            '21 - Skikda'               => '21 - Skikda', 
            '22 - Sidi Bel Abbes'       => '22 - Sidi Bel Abbes', 
            '23 - Annaba'               => '23 - Annaba',
            '24 - Guelma'               => '24 - Guelma', 
            '25 - Constantine'          => '25 - Constantine', 
            '26 - Medea'                => '26 - Medea', 
            '27 - Mostaganem'           => '27 - Mostaganem', 
            '28 - MSila'                => '28 - MSila', 
            '29 - Mascara'              => '29 - Mascara',
            '30 - Ouargla'              => '30 - Ouargla', 
            '31 - Oran'                 => '31 - Oran', 
            '32 - Bayadh'               => '32 - Bayadh', 
            '33 - Illizi'               => '33 - Illizi', 
            '34 - Bordj Bou Arreridj'   => '34 - Bordj Bou Arreridj',
            '35 - Boumerdes'            => '35 - Boumerdes', 
            '36 - El Tarf'              => '36 - El Tarf', 
            '37 - Tindouf'              => '37 - Tindouf', 
            '38 - Tissemsilt'           => '38 - Tissemsilt', 
            '39 - El Oued'              => '39 - El Oued',
            '40 - Khenchela'            => '40 - Khenchela', 
            '41 - Souk Ahras'           => '41 - Souk Ahras', 
            '42 - Tipaza'               => '42 - Tipaza', 
            '43 - Mila'                 => '43 - Mila', 
            '44 - Ain Defla'            => '44 - Ain Defla', 
            '45 - Naama'                => '45 - Naama',
            '46 - Ain Temouchent'       => '46 - Ain Temouchent', 
            '47 - Ghardaia'             => '47 - Ghardaia', 
            '48 - Relizane'             => '48 - Relizane'
        );
        $builder
            ->add('maj', 'hidden', array('required' => false))
            ->add('type', 'choice', array(
                                    'choices' => array(
                                                    '1' => 'Je propose des places',
                                                    '0' => 'Je cherche des places'
                                                ),
                                    'expanded' => true,
                                    'multiple' => false,
                                    'data' => '1'
                                  )
            )
            ->add('filles', 'checkbox', array('required' => false))
            ->add('date', 'date', array(
                                    'widget' => 'single_text',
                                    'input'  => 'datetime',
                                    'format' => 'dd/MM/yyyy',
                                    'attr'   => array('class' => 'date ouardep'),
                                )
            )
            ->add('heure', 'text', array(
                                    'required' => false,
                                    'attr'   => array('class' => 'ouardep'),
                                 )
            )
            ->add('depart', 'choice', array(
                                        'choices'  => $wilaya,
                                        'multiple' => false,
                                        'preferred_choices' => array('16 - Alger'),
                                    )
            )
            ->add('villea', 'text', array(
                                        'attr'   => array('class' => 'ouardep'),
                                  )
            )
            ->add('arrivee', 'choice', array(
                                        'choices'    => $wilaya,
                                        'multiple' => false,
                                        'preferred_choices' => array('06 - Bejaia'),
                                    )
            )
            ->add('villeb', 'text', array(
                                        'attr' => array('class' => 'ouardep'),
                                  )
            )
            ->add('place', 'choice', array(
                                        'choices' => array(
                                                        '1' => '1',
                                                        '2' => '2',
                                                        '3' => '3',
                                                        '4' => '4',
                                                        '5' => '5'
                                                    ),
                                        'multiple' => false
                                    )
            )
            ->add('vehicule', 'text', array(
                                        'required' => false,
                                        'attr'   => array('class' => 'ouardep'),
                                    )
            )
            ->add('prix', 'choice', array(
                                        'choices' => array(
                                                        '0' => '0',
                                                        '50' => '50',
                                                        '100' => '100',
                                                        '150' => '150',
                                                        '200' => '200',
                                                        '250' => '250',
                                                        '300' => '300',
                                                        '350' => '350',
                                                        '400' => '400',
                                                        '450' => '450',
                                                        '500' => '500'
                                                    ),
                                        'multiple' => false
                                  )
            )
            ->add('message', 'textarea', array(
                                            'required' => false,
                                            'attr'     => array('class' => 'ouardepp',
                                                                'cols'  => '550',
                                                                'rows'  => '3'),
                                       )
            )
            ->add('categorie', 'choice', array(
                                    'choices' => array(
                                                    '0' => 'Professionnel',
                                                    '1' => 'Études',
                                                    '2' => 'Autre'
                                                ),
                                    'expanded' => true,
                                    'multiple' => false,
                                    'data' => '0'
                                  )
            )
            ->add('fumer',   'checkbox',   array('required' => false))
            ->add('musique', 'checkbox',   array('required' => false))
            ->add('animal',  'checkbox',   array('required' => false))
            ->add('blabla',  'checkbox',   array('required' => false))
            ->add('jours', new JoursType())
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Base\NrohoBundle\Entity\Product',
            'intention'  => 'task_form',
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'base_nrohobundle_product';
    }
}
