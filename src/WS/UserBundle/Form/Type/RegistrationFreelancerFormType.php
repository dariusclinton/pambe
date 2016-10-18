<?php

namespace WS\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationFreelancerFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('sexe', 'choice', array(
                'mapped' => true,
                'choices' => array(
                    "Homme" => "Homme",
                    "Femme" => "Femme"
                ),
                'preferred_choices' => array('Homme')
            ));
    }

    public function getParent()
    {
        return 'WS\UserBundle\Form\Type\RegistrationType';
    }

    public function getBlockPrefix()
    {
        return 'freelancer_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}