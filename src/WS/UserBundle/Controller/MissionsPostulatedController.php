<?php

namespace WS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MissionsPostulatedController extends Controller
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

        return $this->render('WSUserBundle:Profile_Missions_Postulated:index.html.twig', [
            "user" => $user
        ]);
    }
}
