<?php

namespace WS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class DomainController extends Controller
{
    //    Retoune User
    public function getUser() {
        return $this->get('security.token_storage')->getToken()->getUser();
    }
    //    Retourne EntityManager
    public function getEM() {
        return $this->getDoctrine()->getManager();
    }

    public function domainsByCategoryAction($id) {
        $em = $this->getEM();
        $domains = $em->getRepository('WSUserBundle:Domain')->findAllDomainByCategory($id);

        $response = new JsonResponse();
        return $response->setData([
            "response" => $domains
        ]);
    }

    public function domainsByUserAction() {
        $em = $this->getEM();
        $domains = $em->getRepository('WSUserBundle:Domain')->findAllDomainByUser($this->getUser()->getId());

        $response = new JsonResponse();
        return $response->setData([
            "response" => $domains
        ]);
    }

    public function indexAction() {
        $user =$this->getUser();
        $em = $this->getEM();
        $categories_list =  $em->getRepository('WSUserBundle:Category')->findAll();

        return $this->render('WSUserBundle:Profile_Domain:index.html.twig', [
            "user" => $user,
            "categories" => $categories_list
        ]);
    }

    public function addAction($id) {
        $em = $this->getEM();
        $domain = $em->getRepository('WSUserBundle:Domain')->find($id);
        $user = $this->getUser();
        $user->addDomain($domain);

        $em->merge($user);
        $em->flush();

        $response = new JsonResponse();
        return $response->setData(array("response" => true));
    }

    public function removeAction($id) {
        $em = $this->getEM();
        $domain = $em->getRepository('WSUserBundle:Domain')->find($id);
        $user = $this->getUser();
        $user->removeDomain($domain);

        $em->merge($user);
        $em->flush();

        $response = new JsonResponse();
        return $response->setData(array("response" => true));
    }
}
