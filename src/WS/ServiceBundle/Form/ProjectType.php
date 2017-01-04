<?php

namespace WS\ServiceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use WS\UserBundle\Form\MediaType;

class ProjectType extends AbstractType
{
  /**
   * {@inheritdoc}
   */
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder
      ->add('object', TextType::class, array(
        'label' => 'Nom de votre projet',
        'attr' => array(
          'placeholder' => "Refonte de site web, Développement d'application android"
        )
      ))
      ->add('description', TextareaType::class, array(
        'label' => 'Description des tâches à réaliser',
        'attr' => array(
          'rows' => 15
        )
      ))
      ->add('place')
      ->add('country')
      ->add('duration', TextType::class, array(
        'label' => 'Durée (en jours)'
      ))
      ->add('budget', TextType::class, array(
        'label' => 'Budget approximatif à la réalisation du projet'
      ))
      ->add('startDate', DateType::class, array(
        'label' => 'Date de début du projet'
      ))
      ->add('domains', 'entity', [
        'class' => 'WSUserBundle:Domain',
        'property' => 'libel',
        'multiple' => true,
        'required' => true,
        'label' => 'Compétences requises à la réalisation du projet'
      ])
      ->add('fichier', new MediaType(), [
        'required' => false,
        'label' => 'Attacher un fichier'
      ]);
  }

  /**
   * {@inheritdoc}
   */
  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults(array(
      'data_class' => 'WS\ServiceBundle\Entity\Project'
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
