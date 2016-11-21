<?php

namespace WS\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Security;

class CoreController extends Controller
{
  /**
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function indexAction()
  {
    /*
     * Login user
     */
    $ws_user_login = $this->get('ws_user.login');
    $ws_user_login->login();
    
    return $this->render('WSCoreBundle:Core:index.html.twig', array(
      'last_username' => $ws_user_login->getLastUsername(),
      'error' => $ws_user_login->getError(),
      'csrf_token' => $ws_user_login->getCsrfToken(),
    ));
  }

  /**
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function aboutAction() {
    /*
     * Login user
     */
    $ws_user_login = $this->get('ws_user.login');
    $ws_user_login->login();

    return $this->render('WSCoreBundle:Core:about.html.twig', array(
      'last_username' => $ws_user_login->getLastUsername(),
      'error' => $ws_user_login->getError(),
      'csrf_token' => $ws_user_login->getCsrfToken(),
    ));
  }

  /**
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function contactAction() {
    /*
     * Login user
     */
    $ws_user_login = $this->get('ws_user.login');
    $ws_user_login->login();

    return $this->render('WSCoreBundle:Core:contact.html.twig', array(
      'last_username' => $ws_user_login->getLastUsername(),
      'error' => $ws_user_login->getError(),
      'csrf_token' => $ws_user_login->getCsrfToken(),
    ));
  }

  /**
   * @return \Symfony\Component\HttpFoundation\Response
   */
  public function howtoAction() {
    /*
     * Login user
     */
    $ws_user_login = $this->get('ws_user.login');
    $ws_user_login->login();
    
    return $this->render('WSCoreBundle:Core:howto.html.twig', array(
      'last_username' => $ws_user_login->getLastUsername(),
      'error' => $ws_user_login->getError(),
      'csrf_token' => $ws_user_login->getCsrfToken(),
    ));
  }
}
