<?php

namespace WS\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use WS\UserBundle\Form\MediaType;

class RegistrationType extends AbstractType {
  
  public function buildForm(FormBuilderInterface $builder, array $options) {
    $builder
        ->add('nom')
        ->add('prenom')
        ->add('country')
        ->add('adresse')
        ->add('image', new MediaType(), ['required' => false]);
  }
  
  public function getParent()
  {
      return 'FOS\UserBundle\Form\Type\RegistrationFormType';
  }

  public function getBlockPrefix()
  {
      return 'user_registration';
  }

  // For Symfony 2.x
  public function getName()
  {
      return $this->getBlockPrefix();
  }
}
