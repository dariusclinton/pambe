<?php

namespace WS\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DonateController extends Controller
{
    public function indexAction()
    {
        return $this->render('WSAdminBundle:Donate:index.html.twig');
    }
}
