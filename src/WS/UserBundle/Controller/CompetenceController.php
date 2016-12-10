<?php

namespace WS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use WS\UserBundle\Entity\Competence;

class CompetenceController extends Controller {

    //    Retoune User
    public function getUser() {
        return $this->get('security.token_storage')->getToken()->getUser();
    }
    //    Retourne EntityManager
    public function getEM() {
        return $this->getDoctrine()->getManager();
    }

    public function indexAction() {
        $user =$this->getUser();

        return $this->render('WSUserBundle:Profile_Competence:index.html.twig', [
            "user" => $user
        ]);
    }

    public function competencesByUserAction() {
        $em = $this->getEM();
        $competences = $em->getRepository('WSUserBundle:Competence')->findAllCompetenceByUser($this->getUser()->getId());

        $response = new JsonResponse();
        return $response->setData([
            "response" => $competences
        ]);
    }

    public function addAction() {
        $em = $this->getEM();
        $r = $this->get('request');

        $competence = new Competence();
        $competence->setLibel(urldecode($r->request->get('libelle')));
        $competence->setNbAnneeExp($r->request->get('nbAnneeExp'));
        $competence->setFreelancer($this->getUser());

        $em->persist($competence);
        $em->flush();

        $response = new JsonResponse();
        return $response->setData(array("response" => true));
    }

    public function removeAction($id) {
        $em = $this->getEM();
        $competence = $em->getRepository('WSUserBundle:Competence')->find($id);

        $em->remove($competence);
        $em->flush();

        $response = new JsonResponse();
        return $response->setData(array("response" => true));
    }
}
