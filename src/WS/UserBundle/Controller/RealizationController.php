<?php

namespace WS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use WS\UserBundle\Entity\Realization;
use WS\UserBundle\Form\RealizationType;

class RealizationController extends Controller {

    //    Retoune User
    public function getUser() {
        return $this->get('security.token_storage')->getToken()->getUser();
    }
    //    Retourne EntityManager
    public function getEM() {
        return $this->getDoctrine()->getManager();
    }

    public function indexAction() {
        $em = $this->getEM();
        $user =$this->getUser();
        $realization = new Realization();
        $form = $this->createForm(new RealizationType(), $realization);

        $request = $this->getRequest();
        if ($request->getMethod() == 'POST') {
            $form->bind($request);

            if ($realization->getImage() != null) {
                if ($realization->getImage()->getPath() === 'fileName') {
                    $realization->getImage()->setPath('');
                }
                $realization->getImage()->setDirectory("images");
            }

            $realization->setFreelancer($user);

            $em->persist($realization);
            $em->flush();

            return $this->redirect($this->generateUrl('profile_realization_index'));
        }

        return $this->render('WSUserBundle:Profile_Realization:index.html.twig', [
            "user" => $user,
            'form' => $form->createView()
        ]);
    }

    public function removeAction($id) {
        $em = $this->getEM();
        $realization = $em->getRepository('WSUserBundle:Realization')->find($id);
        $em->remove($realization);
        $em->flush();

        return $this->redirect($this->generateUrl('profile_realization_index'));
    }
}
