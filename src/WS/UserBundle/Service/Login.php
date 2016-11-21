<?php
/**
 * Created by PhpStorm.
 * User: tsafack
 * Date: 22/10/16
 * Time: 17:15
 */

namespace WS\UserBundle\Service;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Csrf\CsrfTokenManager;
use Symfony\Component\Security\Core\Security;

class Login
{
  private $csrfTokenManager = null;
  private $request = null;
  
  private $error;
  private $lastUsername;
  private $csrfToken;

  public function __construct(Request $request, CsrfTokenManager $csrfTokenManager)
  {
    $this->csrfTokenManager = $csrfTokenManager;
    $this->request = $request;
  }

  /*
     * Login user
     */

  public function login()
  {
    /*
     * Login user
     */
    /** @var $session \Symfony\Component\HttpFoundation\Session\Session */
    $session = $this->request->getSession();

    $authErrorKey = Security::AUTHENTICATION_ERROR;
    $lastUsernameKey = Security::LAST_USERNAME;

    // get the error if any (works with forward and redirect -- see below)
    if ($this->request->attributes->has($authErrorKey)) {
      $error = $this->request->attributes->get($authErrorKey);
    } elseif (null !== $session && $session->has($authErrorKey)) {
      $error = $session->get($authErrorKey);
      $session->remove($authErrorKey);
    } else {
      $error = null;
    }

    if (!$error instanceof AuthenticationException) {
      $error = null; // The value does not come from the security component.
    }

    // last username entered by the user
    $this->lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);

    $this->csrfToken = $this->csrfTokenManager
      ? $this->csrfTokenManager->getToken('authenticate')->getValue()
      : null;
  }

  /**
   * @return mixed
   */
  public function getError()
  {
    return $this->error;
  }

  /**
   * @return mixed
   */
  public function getLastUsername()
  {
    return $this->lastUsername;
  }

  /**
   * @return mixed
   */
  public function getCsrfToken()
  {
    return $this->csrfToken;
  }
  
  
}