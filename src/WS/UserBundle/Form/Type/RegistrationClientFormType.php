<?php

namespace WS\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationClientFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('siteWeb');
    }

    public function getParent()
    {
        return 'WS\UserBundle\Form\Type\RegistrationType';
    }

    public function getBlockPrefix()
    {
        return 'client_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}