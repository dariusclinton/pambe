<?php

namespace WS\UserBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class RegistrationClientController extends Controller
{
    public function registerAction()
    {
        return $this->container
                    ->get('pugx_multi_user.registration_manager')
                    ->register('WS\UserBundle\Entity\Client');
    }
}
