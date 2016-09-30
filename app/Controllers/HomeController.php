<?php

namespace App\Controllers;

class HomeController extends Controller
{
  /**
    * The controller for handling routes that are not available multiple languages
    */

  public function test($request, $response)
  {
    return $this->view->render($response, 'test.twig');
  }
}
