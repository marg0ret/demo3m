<?php
// DIC configuration
$container = $app->getContainer();

// Database
$container['capsule'] = function ($c) {
    $capsule = new Illuminate\Database\Capsule\Manager;
    $capsule->addConnection($c['settings']['db']);
    return $capsule;
};

// View
$container['view'] = function ($c) {
    $view = new \Slim\Views\Twig($c['settings']['view']['template_path'], $c['settings']['view']['twig']);
    // Add extensions
    $view->addExtension(new Slim\Views\TwigExtension($c['router'], $c['request']->getUri()));
    $view->addExtension(new Twig_Extension_Debug());
//  $view->addExtension(new Bookshelf\TwigExtension($c['flash']));
    return $view;
};

// CSRF guard
$container['csrf'] = function ($c) {
    $guard = new \Slim\Csrf\Guard();
    $guard->setFailureCallable(function ($request, $response, $next) {
        $request = $request->withAttribute("csrf_status", false);
        return $next($request, $response);
    });
    return $guard;
};
// Flash messages
$container['flash'] = function ($c) {
   return new \Slim\Flash\Messages;
};

$container['welcome'] = function ($c) {
    $welcome = new \Slim\Views\Twig('../app/templates');
    $welcome->addExtension(new \Slim\Views\TwigExtension(
        $c['router'],
        $c['request']->getUri()
    ));
    $welcome->getEnvironment()->addGlobal('flash', $c['flash']);
    return $welcome;
};

$container['App\Action\UserController'] = function ($c) {
   return new App\Action\UserController($c['view'], $c['router'], $c['flash']);
};

