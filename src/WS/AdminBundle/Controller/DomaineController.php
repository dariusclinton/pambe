<?php
/**
 * Created by PhpStorm.
 * User: Aurelien KOUAM
 * Date: 21/10/2016
 * Time: 06:29
 */

namespace WS\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use WS\UserBundle\Entity\Domain;
use WS\UserBundle\Form\DomainType;

class DomaineController extends Controller {

    public function indexAction()
    {
        $domain = new Domain();
        $form = $this->createForm(new DomainType(), $domain);

        $em = $this->getDoctrine()->getManager();

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($domain->getImage()->getPath() === 'user.png') {
                $domain->getImage()->setPath('');
            }

            $domain->getImage()->setDirectory("images");

            $em->persist($domain);
            $em->flush();

            $this->get('session')->getFlashBag()->Add('success', "Domaine crée avec succès!");
            return $this->redirect($this->generateUrl('ws_admin_domain'));
        }

        $domain_list =  $em->getRepository('WSUserBundle:Domain')->findAll();

        return $this->render('WSAdminBundle:Domaine:index.html.twig',
            [
                'form' => $form->createView(),
                'domains' => $domain_list
            ]
        );
    }

    public function deleteAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $domain = $em->getRepository('WSUserBundle:Domain')->find($id);
        try {
            $em->remove($domain);
            $em->flush();
        } catch(ConstraintViolationException $e) {
            $this->get('session')->getFlashBag()->Add('danger', "Vous ne pouvez pas supprimer ce Domaine!");
            return $this->redirect($this->generateUrl('ws_admin_domain'));
        }
        $this->get('session')->getFlashBag()->Add('success', "Domaine supprimée avec succès!");
        return $this->redirect($this->generateUrl('ws_admin_domain'));
    }

    public function updateAction($id) {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();
        $domain = $em->getRepository('WSUserBundle:Domain')->find($id);

        $form = $this->createForm(new DomainType(), $domain);

        if ($request->getMethod() == 'POST'){
            $form->handleRequest($request);

            $domain->getImage()->setDirectory("images");

            $em->merge($domain);
            $em->flush();
            $this->get('session')->getFlashBag()->Add('success', "Ce domaine a été modifié avec succès!");
            return $this->redirect($this->generateUrl('ws_admin_domain'));
        }

        return $this->render('WSAdminBundle:Domaine:update.html.twig', [
            'form' => $form->createView(),
            'domain' => $domain
        ]);
    }
}