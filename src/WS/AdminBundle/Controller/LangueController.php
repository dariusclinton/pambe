<?php
/**
 * Created by PhpStorm.
 * User: Aurelien KOUAM
 * Date: 21/10/2016
 * Time: 06:29
 */

namespace WS\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use WS\UserBundle\Entity\Langue;
use WS\UserBundle\Form\LangueType;

class LangueController extends Controller {

    public function indexAction()
    {
        $langue = new Langue();
        $form = $this->createForm(new LangueType(), $langue);

        $em = $this->getDoctrine()->getManager();

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            $em->persist($langue);
            $em->flush();

            $this->get('session')->getFlashBag()->Add('success', "Langue crée avec succès!");
            return $this->redirect($this->generateUrl('ws_admin_langue'));
        }

        $langue_list =  $em->getRepository('WSUserBundle:Langue')->findAll();

        return $this->render('WSAdminBundle:Langue:index.html.twig',
            [
                'form' => $form->createView(),
                'langues' => $langue_list
            ]
        );
    }

    public function deleteAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $langue = $em->getRepository('WSUserBundle:Langue')->find($id);
        try {
            $em->remove($langue);
            $em->flush();
        } catch(ConstraintViolationException $e) {
            $this->get('session')->getFlashBag()->Add('danger', "Vous ne pouvez pas supprimer cette langue!");
            return $this->redirect($this->generateUrl('ws_admin_langue'));
        }
        $this->get('session')->getFlashBag()->Add('success', "Langue supprimée avec succès!");
        return $this->redirect($this->generateUrl('ws_admin_langue'));
    }

    public function updateAction($id) {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();
        $langue = $em->getRepository('WSUserBundle:Langue')->find($id);

        $form = $this->createForm(new LangueType(), $langue);

        if ($request->getMethod() == 'POST'){
            $form->handleRequest($request);

            $em->merge($langue);
            $em->flush();
            $this->get('session')->getFlashBag()->Add('success', "Cette langue a été modifié avec succès!");
            return $this->redirect($this->generateUrl('ws_admin_langue'));
        }

        return $this->render('WSAdminBundle:Langue:update.html.twig', [
            'form' => $form->createView(),
            'langue' => $langue
        ]);
    }
}