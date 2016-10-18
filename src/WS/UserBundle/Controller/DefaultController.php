<?php

namespace WS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WSUserBundle:Default:index.html.twig');
    }
}
