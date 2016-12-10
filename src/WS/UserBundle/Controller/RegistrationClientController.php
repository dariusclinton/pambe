<?php

namespace WS\UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use WS\UserBundle\Entity\Client;
use WS\UserBundle\Form\Type\RegistrationClientFormType;

class RegistrationClientController extends Controller
{
    public function registerAction()
    {
        return $this->container
                    ->get('pugx_multi_user.registration_manager')
                    ->register('WS\UserBundle\Entity\Client');
    }
}
