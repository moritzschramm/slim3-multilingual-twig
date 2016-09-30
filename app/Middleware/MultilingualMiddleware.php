<?php

namespace App\Middleware;

class MultilingualMiddleware
{
  protected $container;

  public function __construct($container)
  {
    $this->router = $container->router;
  }

  public function __invoke($request, $response, $next)
  {
    $lang = '';
  	if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
  	  $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

    switch($lang) {

      case 'de':
        return $response->withRedirect($this->router->pathFor('de_'.$request->getAttribute('route')->getName()));
      case 'en':
        return $response->withRedirect($this->router->pathFor('en_'.$request->getAttribute('route')->getName()));

      default:
        return $response->withRedirect($this->router->pathFor('en_'.$request->getAttribute('route')->getName()));
    }
  }
}
