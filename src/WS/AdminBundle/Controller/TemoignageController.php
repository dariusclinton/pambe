<?php

namespace WS\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use WS\ServiceBundle\Entity\Testimonial;
use WS\ServiceBundle\Form\TestimonialType;

class TemoignageController extends Controller
{
    public function getCurrentUser() {
        $token = $this->get('security.token_storage')->getToken();
        return $token->getUser();
    }

    public function indexAction()
    {
        $testimonial = new Testimonial();
        $form = $this->createForm(new TestimonialType(), $testimonial);

        $em = $this->getDoctrine()->getManager();

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            $testimonial->setUser($this->getCurrentUser());

            $em->persist($testimonial);
            $em->flush();

            $this->get('session')->getFlashBag()->Add('success', "Témoignage crée avec succès!");
            return $this->redirect($this->generateUrl('ws_admin_testimonial'));
        }

        $testimonial_list =  $em->getRepository('WSServiceBundle:Testimonial')->findAll();

        return $this->render('WSAdminBundle:Temoignage:index.html.twig',
            [
                'form' => $form->createView(),
                'testimonials' => $testimonial_list
            ]
        );
    }

    public function deleteAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $testimonial = $em->getRepository('WSServiceBundle:Testimonial')->find($id);
        try {
            $em->remove($testimonial);
            $em->flush();
        } catch(ConstraintViolationException $e) {
            $this->get('session')->getFlashBag()->Add('danger', "Vous ne pouvez pas supprimer ce Témoignage!");
            return $this->redirect($this->generateUrl('ws_admin_testimonial'));
        }
        $this->get('session')->getFlashBag()->Add('success', "Témoignage supprimée avec succès!");
        return $this->redirect($this->generateUrl('ws_admin_testimonial'));
    }

    public function updateAction($id) {
        $request = $this->get('request');
        $em = $this->getDoctrine()->getManager();
        $testimonial = $em->getRepository('WSServiceBundle:Testimonial')->find($id);

        $form = $this->createForm(new TestimonialType(), $testimonial);

        if ($request->getMethod() == 'POST'){
            $form->handleRequest($request);

            $testimonial->setUser($this->getCurrentUser());
            $testimonial->setDateTime(new \DateTime);

            $em->merge($testimonial);
            $em->flush();
            $this->get('session')->getFlashBag()->Add('success', "Ce Témoignage a été modifié avec succès!");
            return $this->redirect($this->generateUrl('ws_admin_testimonial'));
        }

        return $this->render('WSAdminBundle:Temoignage:update.html.twig', [
            'form' => $form->createView(),
            'testimonial' => $testimonial
        ]);
    }
}
