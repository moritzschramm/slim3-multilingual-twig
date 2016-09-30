<?php

namespace App\Controllers;

class GermanController extends Controller
{
  public static $route = '/de';     # The route for the group in routes.php
  public static $dir = 'de/';       # Defines the directory in which the template files are stored
  public static $prefix = 'de_';    # The prefix of the route's name 

  public function home($request, $response)
  {
    return $this->view->render($response, GermanController::$dir . 'home.twig');
  }

  public function contact($request, $response)
  {
    return $this->view->render($response, GermanController::$dir . 'contact.twig');
  }
}
