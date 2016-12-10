<?php

namespace WS\UserBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use WS\UserBundle\Form\MediaType;


class ProfileClientFormType extends AbstractType {
  
  public function buildForm(FormBuilderInterface $builder, array $options) {
      $builder
          ->add('image', new MediaType(), ['required' => false])
          ->add('nom')
          ->add('prenom')
          ->add('country')
          ->add('adresse')
          ->add('siteWeb');
  }
  
  public function getParent() {
    return 'FOS\UserBundle\Form\Type\ProfileFormType';
  }
  
  public function getBlockPrefix()
  {
      return 'client_profile';
  }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }
}