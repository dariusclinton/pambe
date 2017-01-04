<?php

namespace WS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use WS\ServiceBundle\Entity\Mission;

class MyMissionsController extends Controller
{
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

        return $this->render('WSUserBundle:Profile_MyMissions:index.html.twig', [
            "user" => $user
        ]);
    }

    // Index liste Postulant ou Solicité
    public function postulantOrSolicitAction(Mission $mission) {
        return $this->render('WSUserBundle:Profile_MyMissions:list_postulantOrsolicit_index.html.twig', [
            'mission' => $mission,
            'user' => $this->getUser()
        ]);
    }
}
