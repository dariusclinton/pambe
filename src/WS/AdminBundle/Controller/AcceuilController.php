<?php

namespace WS\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class AcceuilController extends Controller
{
    public function indexAction()
    {
        return $this->render('WSAdminBundle:Acceuil:index.html.twig');
    }
}
