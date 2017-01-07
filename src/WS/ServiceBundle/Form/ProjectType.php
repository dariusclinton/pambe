<?php

namespace WS\ServiceBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use WS\UserBundle\Form\MediaType;
use WS\UserBundle\Form\Type\RegistrationType;

class ProjectType extends AbstractType
{

    private $tokenStorage;

    public function __construct(TokenStorageInterface $tokenStorage)
    {
        $this->tokenStorage = $tokenStorage;
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
//    $user = $this->tokenStorage->getToken()->getUser();
//    if (!$user) {
//        $builder
//            ->add('user', UserType::class)
//        ;
//    }

        $builder
            ->add('name', TextType::class, array(
                'label' => 'Nom de votre projet',
                'attr' => array(
                    'placeholder' => "Refonte de site web, Développement d'application android"
                ),
                'required' => true
            ))
            ->add('description', TextareaType::class, array(
                'label' => 'Description des tâches à réaliser',
                'attr' => array(
                    'rows' => 15
                ),
                'required' => true
            ))
            ->add('budget', 'choice', array(
                'label' => 'Budget approximatif à la réalisation du projet',
                'choices' => [
                    'Moins de 50.000 FCFA' => 'Moins de 50.000 FCFA',
                    '50.000 - 250.000 FCFA' => '50.000 - 250.000 FCFA',
                    '250.000 - 500.000 FCFA' => '250.000 - 500.000 FCFA',
                    '500.000 - 750.000 FCFA' => '500.000 - 750.000 FCFA',
                    '750.000 - 1.000.000 FCFA' => '750.000 - 1.000.000 FCFA',
                    'Plus de 1.000.000 FCFA' => 'Plus de 1.000.000 FCFA'
                ],
                'expanded' => true,
                'required' => true
            ))
            ->add('start', 'choice', array(
                'label' => 'Date de début du projet',
                'choices' => [
                    'Tout de suite' => 'Tout de suite',
                    'Ce mois-ci' => 'Ce mois-ci',
                    'Ces prochains mois' => 'Ces prochains mois',
                    'Je ne sais pas' => 'Je ne sais pas',
                ],
                'expanded' => true,
                'required' => true
            ))
            ->add('showCoordonates', 'choice', array(
                'label' => 'Souhaitez vous que vos coordonnées soient affichées?',
                'choices' => [
                    'messagerie' => 'Non, J\'utiliserai la messagerie interne',
                    'email' => 'Oui, mon email',
                    'téléphone' => 'Oui, mon téléphone'
                ],
                'expanded' => true,
                'required' => true
            ))
            ->add('domains', 'entity', [
                'class' => 'WSUserBundle:Domain',
                'property' => 'libel',
                'multiple' => true,
                'required' => true,
                'group_by' => 'category.libelle',
                'label' => 'Compétences requises à la réalisation du projet',
                'required' => true
            ])
            ->add('fichier', MediaType::class, [
                'required' => false,
                'label' => 'Attacher un fichier'
            ])
            ->add('urgent', null, [
                'label' => 'Projet urgent: marquer mon projet urgent'
            ])
            ->add('premium', null, [
                'label' => 'Projet premium: placé au top des projets pendant 5 jours'
            ])
            ->add('user', UserType::class);
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
