<?php

namespace CRH\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TrailType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('length',null,array('label' => 'Length in miles'))
            ->add('type', 'choice', array('choices' => array(
                    'Trails' => 'Trails',
                    'Sidewalks' => 'Sidewalks',
                    'Special Ways' => 'Special Ways',
                    'Blue Ways' => 'Blue Ways'
                )))
            ->add('caloriesBurnedMale')
            ->add('caloriesBurnedFemale')
            ->add('surfaceType')
            ->add('hoursOfOperation', null, array('attr' => array('class' => 'tinymce')))
            ->add('description')
            ->add('imageFile1', 'vich_image', array(
                'required'  => false,
                'download_link' => false
            ))
            ->add('isTrailOfMonth',null,array('label' => 'Set as trail of the month') )

        ;
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CRH\WebBundle\Entity\Trail'
        ));
    }
}
