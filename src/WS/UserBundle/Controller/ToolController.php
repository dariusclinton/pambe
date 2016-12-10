<?php

namespace WS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use WS\UserBundle\Entity\Outil;
use WS\UserBundle\Form\OutilType;

class ToolController extends Controller {
    //    Retoune User
    public function getUser() {
        return $this->get('security.token_storage')->getToken()->getUser();
    }
    //    Retourne EntityManager
    public function getEM() {
        return $this->getDoctrine()->getManager();
    }

    public function indexAction() {
        $outil = new Outil();
        $form = $this->createForm(new OutilType(), $outil);
        $user =$this->getUser();

        return $this->render('WSUserBundle:Profile_Tool:index.html.twig', [
            "user" => $user,
            'form' => $form->createView()
        ]);
    }

    public function toolsByUserAction() {
        $em = $this->getEM();
        $outils = $em->getRepository('WSUserBundle:Outil')->findAllToolByUser($this->getUser()->getId());

        $response = new JsonResponse();
        return $response->setData([
            "response" => $outils
        ]);
    }

    public function addAction() {
        $em = $this->getEM();
        $r = $this->get('request');

        $outil = new Outil();
        $outil->setLibelle(urldecode($r->request->get('libelle')));
        $outil->setNivExpertise($r->request->get('rate'));
        $outil->setFreelancer($this->getUser());

        $em->persist($outil);
        $em->flush();

        $response = new JsonResponse();
        return $response->setData(array("response" => true));
    }

    public function removeAction($id) {
        $em = $this->getEM();
        $outil = $em->getRepository('WSUserBundle:Outil')->find($id);

        $em->remove($outil);
        $em->flush();

        $response = new JsonResponse();
        return $response->setData(array("response" => true));
    }
}
