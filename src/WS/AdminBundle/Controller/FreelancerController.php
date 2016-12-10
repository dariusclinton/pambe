<?php

namespace WS\AdminBundle\Controller;

use Symfony\Component\HttpFoundation\File\File;
use WS\UserBundle\Entity\Freelancer;
use WS\UserBundle\Entity\Media;
use WS\UserBundle\Form\Type\RegistrationFreelancerFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class FreelancerController extends Controller
{
    public function indexAction()
    {
        $freeLancer = new Freelancer();
        $form = $this->createForm(new RegistrationFreelancerFormType(), $freeLancer);

        $em = $this->getDoctrine()->getManager();

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            $freeLancer->setEnabled(true);
            $freeLancer->setLastLogin(new \DateTime);

//            if ($freeLancer->getImage() == null) {
//                $freeLancer->setImage(new Media());
//            }
            $freeLancer->getImage()->setDirectory("profils");

            $em->persist($freeLancer);
            $em->flush();

            $this->get('session')->getFlashBag()->Add('success', "Freelancer crée avec succès!");
            return $this->redirect($this->generateUrl('ws_admin_freelancer'));
        }

        $freeLance_list =  $em->getRepository('WSUserBundle:Freelancer')->findAll();

        return $this->render('WSAdminBundle:Freelancer:index.html.twig',
            [
                'form' => $form->createView(),
                'freelancers' => $freeLance_list
            ]
        );
    }

    public function deleteAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $freeLancer = $em->getRepository('WSUserBundle:Freelancer')->find($id);
        try {
            $em->remove($freeLancer);
            $em->flush();
        } catch(ConstraintViolationException $e) {
            $this->get('session')->getFlashBag()->Add('danger', "Vous ne pouvez pas supprimer ce Freelancer!");
            return $this->redirect($this->generateUrl('ws_admin_freelancer'));
        }
        $this->get('session')->getFlashBag()->Add('success', "Freelancer supprimée avec succès!");
        return $this->redirect($this->generateUrl('ws_admin_freelancer'));
    }

    public function updateAction($id) {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();
        $freeLancer = $em->getRepository('WSUserBundle:Freelancer')->find($id);

        $form = $this->createForm(new RegistrationFreelancerFormType(), $freeLancer);

        if ($request->getMethod() == 'POST'){
            $form->handleRequest($request);

            $freeLancer->getImage()->setDirectory("profils");

            $em->merge($freeLancer);
            $em->flush();
            $this->get('session')->getFlashBag()->Add('success', "Ce Freelancer a été modifié avec succès!");
            return $this->redirect($this->generateUrl('ws_admin_freelancer'));
        }

        return $this->render('WSAdminBundle:Freelancer:update.html.twig', [
            'form' => $form->createView(),
            'freelancer' => $freeLancer
        ]);
    }

    public function AbleOrEnableAction($id, $val) {
        $em = $this->getDoctrine()->getManager();
        $freeLancer = $em->getRepository('WSUserBundle:Freelancer')->find($id);

        $freeLancer->setEnabled($val);
        $em->merge($freeLancer);
        $em->flush();

        if ($val == 1) {
            $this->get('session')->getFlashBag()->Add('success', "Freelance annulée avec succès");
        } else {
            $this->get('session')->getFlashBag()->Add('success', "Freelance ratifée avec succès");
        }
        return $this->redirect($this->generateUrl('ws_admin_freelancer'));
    }
}
