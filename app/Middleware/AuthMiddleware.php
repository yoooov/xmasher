<?php

namespace Xmasher\Middleware;
/**
 * If a request is made to the account page and the user is not not logedin
 * we redirect him the login page
 */
class AuthMiddleware extends Middleware
{
  public function __invoke($request, $response, $next)
  {
    if (!$this->container->auth->check()) {
      $this->container->flash->addMessage('error', 'Veuillez vous connecter pour accéder au paramètre de votre compte.');
      return $response->withRedirect($this->container->router->pathFor('auth.signin'));
    }

    return $next($request, $response);
  }
}
