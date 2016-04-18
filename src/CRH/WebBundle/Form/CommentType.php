<?php

namespace CRH\WebBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CommentType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('message')
            ->add('image')
//            ->add('date', 'datetime')
            ->add('trail')
            ->add('email');
            
            if(isset($options["attr"]["admin"]))
            {
                $builder->add('isApproved');
            }
        
    }
    
    /**
     * @param OptionsResolver $resolver
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CRH\WebBundle\Entity\Comment'
        ));
    }
}
