<?php

namespace WS\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class DomainType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('libel')
                ->add('description' , 'text', array('required' => false))
                ->add('image', new MediaType())
                ->add('category', 'entity', array(
                    'class' => 'WSUserBundle:Category',
                    'property' => 'libelle',
                    'empty_value' => '--Catégorie--'));
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WS\UserBundle\Entity\Domain'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ws_userbundle_domain';
    }


}
