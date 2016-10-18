<?php

namespace WS\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class TemoignageController extends Controller
{
    public function indexAction()
    {
        return $this->render('WSAdminBundle:Temoignage:index.html.twig');
    }
}
