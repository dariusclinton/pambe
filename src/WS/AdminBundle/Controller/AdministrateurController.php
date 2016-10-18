<?php

namespace WS\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AdministrateurController extends Controller
{
    public function indexAction()
    {
        //return $this->render('WSAdminBundle:Administrateur:index.html.twig');

        return $this->container
            ->get('pugx_multi_user.registration_manager')
            ->register('WS\UserBundle\Entity\Admin');
    }
}
