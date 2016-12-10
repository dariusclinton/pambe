<?php

namespace WS\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use WS\UserBundle\Entity\Freelancer;
use WS\UserBundle\Form\Type\RegistrationFreelancerFormType;

class RegistrationFreelancerController extends Controller
{
    public function registerAction()
    {
        return $this->container
                    ->get('pugx_multi_user.registration_manager')
                    ->register('WS\UserBundle\Entity\Freelancer');
    }
}