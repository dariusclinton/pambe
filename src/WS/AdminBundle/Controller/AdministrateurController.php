<?php

namespace WS\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use WS\UserBundle\Entity\Admin;
use WS\UserBundle\Form\Type\RegistrationAdminFormType;

class AdministrateurController extends Controller
{
    public function indexAction()
    {

        $admin = new Admin();
        $form = $this->createForm(new RegistrationAdminFormType(), $admin);

        $em = $this->getDoctrine()->getManager();

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            $admin->setEnabled(true);
            $admin->setLastLogin(new \DateTime);
            $admin->getImage()->setDirectory("profils");

            $em->persist($admin);
            $em->flush();

            $this->get('session')->getFlashBag()->Add('success', "Admin crée avec succès!");
            return $this->redirect($this->generateUrl('ws_admin_admin'));
        }

        $admin_list =  $em->getRepository('WSUserBundle:Admin')->findAll();

        return $this->render('WSAdminBundle:Administrateur:index.html.twig',
            [
                'form' => $form->createView(),
                'admins' => $admin_list
            ]
        );
    }

    public function deleteAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $admin = $em->getRepository('WSUserBundle:Admin')->find($id);
        try {
            $em->remove($admin);
            $em->flush();
        } catch(ConstraintViolationException $e) {
            $this->get('session')->getFlashBag()->Add('danger', "Vous ne pouvez pas supprimer cet Administrateur!");
            return $this->redirect($this->generateUrl('ws_admin_admin'));
        }
        $this->get('session')->getFlashBag()->Add('success', "Administrateur supprimé avec succès!");
        return $this->redirect($this->generateUrl('ws_admin_admin'));
    }

    public function AbleOrEnableAction($id, $val) {
        $em = $this->getDoctrine()->getManager();
        $admin = $em->getRepository('WSUserBundle:Admin')->find($id);

        $admin->setEnabled($val);
        $em->merge($admin);
        $em->flush();

        if ($val == 1) {
            $this->get('session')->getFlashBag()->Add('success', "Administrateur annulé avec succès");
        } else {
            $this->get('session')->getFlashBag()->Add('success', "Administrateur ratifé avec succès");
        }
        return $this->redirect($this->generateUrl('ws_admin_admin'));
    }

    public function updateAction($id) {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();
        $admin = $em->getRepository('WSUserBundle:Admin')->find($id);

        $form = $this->createForm(new RegistrationAdminFormType(), $admin);

        if ($request->getMethod() == 'POST'){
            $form->handleRequest($request);

            $admin->getImage()->setDirectory("profils");

            $em->merge($admin);
            $em->flush();
            $this->get('session')->getFlashBag()->Add('success', "Cet administrateur a été modifié avec succès!");
            return $this->redirect($this->generateUrl('ws_admin_admin'));
        }

        return $this->render('WSAdminBundle:Administrateur:update.html.twig', [
            'form' => $form->createView(),
            'admin' => $admin
        ]);
    }
}
