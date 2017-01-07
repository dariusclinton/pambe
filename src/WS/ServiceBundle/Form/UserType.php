<?php

namespace WS\ServiceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class UserType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', TextType::class, [
                'required' => true
            ])
            ->add('nom', TextType::class, [
                'required' => true
            ])
            ->add('prenom', TextType::class, [
                'required' => true
            ])
            ->add('adresse', TextType::class, [
                'required' => true
            ])
            ->add('phoneNumber', TextType::class, [
                'required' => true
            ])
            ->add('enterpriseName', TextType::class, [
                'required' => true
            ])
            ->remove('plainPassword')
            ->remove('username');
    }

    public function getBlockPrefix()
    {
        return 'user_registration_project';
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}
