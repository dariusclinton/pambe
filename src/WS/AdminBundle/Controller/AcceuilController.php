<?php

namespace WS\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class AcceuilController extends Controller {

    public function indexAction() {
        return $this->render('WSAdminBundle:Acceuil:index.html.twig');
    }

    public function counterAction() {
        $em = $this->getDoctrine()->getManager();

        $users = $em->getRepository('WSUserBundle:User')->findAll();
        $freelances = $em->getRepository('WSUserBundle:Freelancer')->findAll();
        $clients = $em->getRepository('WSUserBundle:Client')->findAll();
        $projects = $em->getRepository('WSServiceBundle:Project')->findAll();

        $result = [
            "count_users" => count($users),
            "count_freelances" => count($freelances),
            "count_clients" => count($clients),
            "count_projects" => count($projects),
        ];

        $response = new JsonResponse();
        return $response->setData([
            "response" => $result
        ]);
    }
}
