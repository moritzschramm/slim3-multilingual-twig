<?php

namespace App\Controllers;

class EnglishController extends Controller
{
  public static $route = '/en';   # The route for the group in routes.php
  public static $dir = 'en/';     # Defines the directory in which the template files are stored
  public static $prefix = 'en_';  # The prefix of the route's name

  public function home($request, $response)
  {
    return $this->view->render($response, EnglishController::$dir . 'home.twig');
  }

  public function contact($request, $response)
  {
    return $this->view->render($response, EnglishController::$dir . 'contact.twig');
  }
}
