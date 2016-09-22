<?php
// Middleware
$app->add($app->getContainer()->get('csrf'));

//Add a middleware to your app
 $app->add(function ($request, $response, $next) {
   $this->view->offsetSet("flash", $this->flash);
   return $next($request, $response);
});

$app->get('/flash', function ($req, $res, $args) {
    // Set flash message for next request
    $this->flash->addMessage('global', 'This is a message');
    $this->view->render($res, 'welcome.twig');
});

