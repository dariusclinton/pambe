<?php

namespace WS\AdminBundle\Controller;

use WS\UserBundle\Entity\Client;
use WS\UserBundle\Form\Type\RegistrationClientFormType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ClientController extends Controller
{
    public function indexAction()
    {
        $client = new Client();
        $form = $this->createForm(new RegistrationClientFormType(), $client);

        $em = $this->getDoctrine()->getManager();

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);
            $client->setEnabled(true);
            $client->setLastLogin(new \DateTime);

            $em->persist($client);
            $em->flush();

            $this->get('session')->getFlashBag()->Add('success', "Client crée avec succès!");
            return $this->redirect($this->generateUrl('ws_admin_client'));
        }

        $client_list =  $em->getRepository('WSUserBundle:Client')->findAll();

        return $this->render('WSAdminBundle:Client:index.html.twig',
            [
                'form' => $form->createView(),
                'clients' => $client_list
            ]
        );
    }

    public function deleteAction($id) {
        $em = $this->getDoctrine()->getEntityManager();
        $client = $em->getRepository('WSUserBundle:Client')->find($id);
        try {
            $em->remove($client);
            $em->flush();
        } catch(ConstraintViolationException $e) {
            $this->get('session')->getFlashBag()->Add('danger', "Vous ne pouvez pas supprimer ce Client!");
            return $this->redirect($this->generateUrl('ws_admin_client'));
        }
        $this->get('session')->getFlashBag()->Add('success', "Client supprimée avec succès!");
        return $this->redirect($this->generateUrl('ws_admin_client'));
    }
}
