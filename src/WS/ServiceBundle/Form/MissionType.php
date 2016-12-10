<?php

namespace WS\ServiceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use WS\UserBundle\Form\MediaType;

class MissionType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('object')
            ->add('description')
            ->add('place')
            ->add('country')
            ->add('duration')
            ->add('budget')
            ->add('startDate')
            ->add('domains', 'entity', [
                'class' => 'WSUserBundle:Domain',
                'property' => 'libel',
                'multiple' => true,
                'required' => true,
            ])
            ->add('fichier', new MediaType(), ['required' => false]);
        ;
    }
    
    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'WS\ServiceBundle\Entity\Mission'
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function getBlockPrefix()
    {
        return 'ws_servicebundle_mission';
    }


}
