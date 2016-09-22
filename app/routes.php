<?php
// Route configuration
// $app->get('/', 'Bookshelf\AuthorController:listAuthors')->setName('list-authors');
// $app->map(['GET', 'POST'], '/{author_id:[0-9]+}/edit',
// 	'Bookshelf\AuthorController:editAuthor')->setName('edit-author');
// $app->get('/{author_id:[0-9]+}', 'Bookshelf\AuthorController:listBooks')->setName('author');
// $app->get('/', 'Bookshelf\BookController:listBooks')->setName('list-books');



// Creating routes
// Psr-7 Request and Response interfaces
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

// HOME ROUTE
// 
$app->get('/', function (Request $request, Response $response, $args)   {
        $vars = [
            'page' => [
            'title' => 'Home',
            'description' => 'Home '
            ],
        ];  
        return $this->view->render($response, 'home.twig', $vars);
    })->setName('home');
$app->map(['POST'], '/login', 'App\Action\UserController:loginAction')->setName('login');

// ABOUT ROUTE
// 
$app->get('/about', function (Request $request, Response $response, $args)   {

$vars = [
            'page' => [
            'title' => 'About Us - Alpha Inc.',
            'description' => 'We\'re a multi-national company specialized in high tech and robotics.'
            ],
        ];  
        return $this->view->render($response, 'about.twig', $vars);
    })->setName('about');

// WELCOME ROUTE
// 
$app->get('/welcome', function (Request $request, Response $response, $args)   {

        $vars = [
            'page' => [
            'title' => 'Welcome.',
            'description' => 'Successful login.'
            ],
        ];  
        return $this->view->render($response, 'welcome.twig', $vars);
    })->setName('welcome');
