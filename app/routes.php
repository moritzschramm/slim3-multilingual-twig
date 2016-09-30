<?php

namespace App;

use App\Controllers\EnglishController;
use App\Controllers\GermanController;

use App\Middleware\MultilingualMiddleware;


/**
  *  GROUP WITHOUT MULTILINGUAL TEMPLATES
  *  DEFINE ROUTES THAT SHOULD NOT BE REDIRECTED HERE
  */
$app->group('/', function () use ($app) {

  $app->get('test', 'HomeController:test')->setName('test');
});

/**
  * GROUP WITH MULTILNGUAL TEMPLATES
  * DEFINE ROUTES THAT SHOULD BE REDIRECTED TO /{lang}/path/for/route HERE
  */
$app->group('/', function () use ($app) {

  # These routes get redirected by the multilingual middleware,
  # but we need to specify a controller function to prevent error messages
  $app->get('home', 'EnglishController:home')->setName('home');
  $app->get('contact', 'EnglishController:contact')->setName('contact');

})->add(new MultilingualMiddleware($app->getContainer()));

/**
  * The actual multilingual routes divided into two groups: en (english), de (deutsch)
  * You can add as many groups as you want, but do not forget to add a redirect in the middleware
  * and a Controller as well
  */
$app->group(EnglishController::$route, function() use ($app) {

  $app->get('/home', 'EnglishController:home')->setName(EnglishController::$prefix . 'home');
  $app->get('/contact', 'EnglishController:contact')->setName(EnglishController::$prefix . 'contact');
});
$app->group(GermanController::$route, function() use ($app) {

  $app->get('/home', 'GermanController:home')->setName(GermanController::$prefix . 'home');
  $app->get('/contact', 'GermanController:contact')->setName(GermanController::$prefix . 'contact');
});
// $app-group(FrenchController::$route ....)
