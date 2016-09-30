<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

$app = new \Slim\App([
  'settings' => [
    'displayErrorDetails' => true,
  ]
]);

$container = $app->getContainer();

$container['view'] = function($container) {

  $view = new \Slim\Views\Twig(__DIR__ . '/../resources/views', [
    'cache' => false,
  ]);

  $view->addExtension(new \Slim\Views\TwigExtension(
    $container->router,
    $container->request->getUri()
  ));

  return $view;
};

/**
  * 404 Handler
  * Since the notFoundHandler has no middleware, we need to implement the multilinguale middleware logic again
  */

$container['notFoundHandler'] = function ($c) {

  return function ($request, $response) use ($c) {

    $lang = '';

    if(isset($_SERVER['HTTP_ACCEPT_LANGUAGE']))
      $lang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

    switch($lang) {

      case 'de':
        return $c['view']->render($response, 'de/error/404.twig', []);
      case 'en':
        return $c['view']->render($response, 'en/error/404.twig', []);
      default:
        return $c['view']->render($response, 'en/error/404.twig', []);
    }
  };
};

$container['HomeController']     = function($container) { return new \App\Controllers\HomeController($container); };
$container['EnglishController']  = function($container) { return new \App\Controllers\EnglishController($container); };
$container['GermanController']   = function($container) { return new \App\Controllers\GermanController($container); };
// $container['ExampleController'] = function($container) { return new \App\Controlles\ExampleController($container); };
// ..


require __DIR__ . '/../app/routes.php';
