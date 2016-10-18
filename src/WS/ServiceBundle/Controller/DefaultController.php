<?php

namespace WS\ServiceBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('WSServiceBundle:Default:index.html.twig');
    }
}
