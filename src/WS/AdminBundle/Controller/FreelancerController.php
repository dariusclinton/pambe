<?php

namespace WS\AdminBundle\Controller;

use WS\UserBundle\Entity\Freelancer;
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
}
