<?php

namespace WS\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use WS\ServiceBundle\Entity\Mission;
use WS\ServiceBundle\Form\MissionType;
use WS\UserBundle\Entity\Media;

class MissionController extends Controller {

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
        if ($user != "anon.") {

            $em = $this->getEM();
            $mission = new Mission();
            $mission->setCountry($user->getCountry());
            $mission->setFichier(new Media());
            $form = $this->createForm(new MissionType(), $mission);

            $request = $this->getRequest();
            if ($request->getMethod() == 'POST') {
                $form->bind($request);

                $mission->getFichier()->setDirectory("fichiers");

                $mission->setUser($user);

                $em->persist($mission);
                $em->flush();

                $this->get('session')->getFlashBag()->Add('success', "Dépôt éffectué avec succès!");
                return $this->redirect($this->generateUrl('profile_my_missions_index'));
            }

            return $this->render('WSCoreBundle:Mission:index.html.twig', [
                "user" => $user,
                'form' => $form->createView()
            ]);

        } else {
            return $this->render('WSCoreBundle:Mission:index.html.twig');
        }

    }

    public function allDomainsAction() {
        $em = $this->getEM();
        $allDomains = $em->getRepository('WSUserBundle:Domain')->findAllDomain();

        $response = new JsonResponse();
        return $response->setData([
           'response' => $allDomains
        ]);
    }

    public function deleteAction($id) {
        $em = $this->getEM();
        $mission = $em->getRepository('WSServiceBundle:Mission')->find($id);
        $em->remove($mission);
        $em->flush();

        $this->get('session')->getFlashBag()->Add('success', "Mission supprimée avec succès");
        return $this->redirect($this->generateUrl('profile_my_missions_index'));
    }

    public function updateAction(Mission $mission) {
        $request = $this->get('request');
        $em = $this->getEM();

        $form = $this->createForm(new MissionType(), $mission);

        if ($request->getMethod() == 'POST'){
            $form->handleRequest($request);

            $mission->getFichier()->setDirectory("fichiers");

            $em->merge($mission);
            $em->flush();

            $this->get('session')->getFlashBag()->Add('success', "La Mission a été modifié avec succès!");
            return $this->redirect($this->generateUrl('profile_my_missions_index'));
        }

        return $this->render('WSCoreBundle:Mission:edit.html.twig', [
            'form' => $form->createView(),
            'mission' => $mission,
            'user' => $this->getUser()
        ]);
    }

    public function openOrCloseAction($id, $val) {
        $em = $this->getDoctrine()->getManager();
        $mission = $em->getRepository('WSServiceBundle:Mission')->find($id);

        $mission->setOpen($val);
        $em->merge($mission);
        $em->flush();

        if ($val == 1) {
            $this->get('session')->getFlashBag()->Add('success', "Mission ouverte avec succès");
        } else {
            $this->get('session')->getFlashBag()->Add('success', "Mission fermée avec succès");
        }
        return $this->redirect($this->generateUrl('profile_my_missions_index'));
    }
}
