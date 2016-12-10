<?php

namespace WS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;

class LanguageController extends Controller {

//    Retoune User
    public function getUser() {
        return $this->get('security.token_storage')->getToken()->getUser();
    }
//    Retourne EntityManager
    public function getEM() {
        return $this->getDoctrine()->getManager();
    }

    public function indexAction() {
        $user = $this->getUser();
        $em = $this->getEM();
        $languages_list =  $em->getRepository('WSUserBundle:Langue')->findAll();
        $languages = [];

        foreach ($languages_list as $l) {
            $compte = 0;
            foreach ($user->getLangues() as $ul) {
                if ($l === $ul) {
                    $compte++;
                }
            }
            if ($compte === 0) {
                $languages[] = $l;
            }
        }

        return $this->render('WSUserBundle:Profile_Language:index.html.twig', [
            "user" => $user,
            "languages" => $languages
        ]);
    }

    public function addAction($id) {
        $em = $this->getEM();
        $language = $em->getRepository('WSUserBundle:Langue')->find($id);
        $user = $this->getUser();
        $user->addLangue($language);

        $em->merge($user);
        $em->flush();

        $response = new JsonResponse();
        return $response->setData(array("response" => true));
    }

    public function removeAction($id) {
        $em = $this->getEM();
        $language = $em->getRepository('WSUserBundle:Langue')->find($id);
        $user = $this->getUser();
        $user->removeLangue($language);

        $em->merge($user);
        $em->flush();

        return $this->redirect($this->generateUrl('profile_language_index'));
    }
}
