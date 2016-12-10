<?php

namespace WS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use WS\UserBundle\Entity\Media;
use WS\UserBundle\Form\MediaType;
use WS\UserBundle\Form\Type\RegistrationClientFormType;
use WS\UserBundle\Form\Type\RegistrationFreelancerFormType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WSUserBundle:Default:index.html.twig');
    }

    public function getUser() {
        return $this->get('security.token_storage')->getToken()->getUser();
    }
    //    Retourne EntityManager
    public function getEM() {
        return $this->getDoctrine()->getManager();
    }

    public function showAction() {

    }

    public function updatePhotoProfilAction() {
        $em = $this->getEM();
        $user = $this->getUser();
        $request = $this->get('request');
        $auth_checker = $this->get('security.authorization_checker');

        $media = $user->getImage();

        if ($media == null) {
            $user->setImage(new Media());
            $em->merge($user);
            $em->flush();
        }

        $form = $this->createForm(new MediaType(), $media);

        if ($request->getMethod() == 'POST'){
            $form->handleRequest($request);

            $media->setDirectory("profils");
            $user->setImage($media);

            $em->merge($user);
            $em->flush();

            return $this->redirect($this->generateUrl('fos_user_profile_show'));
        }

        return $this->render('WSUserBundle:Profile:edit_photo.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }
}
