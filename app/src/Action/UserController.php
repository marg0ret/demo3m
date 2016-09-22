<?php
namespace App\Action;
use Slim\Views\Twig;
use Slim\Router;
use Slim\Flash\Messages as FlashMessages;
use App\Action\User;

final class UserController
{
    private $view;
    private $router;
    private $flash;
    public function __construct(Twig $view, Router $router, FlashMessages $flash)
    {
        $this->view = $view;
        $this->router = $router;
        $this->flash = $flash;
    }
    public function listUsers($request, $response)
    {
        return $this->view->render($response, 'list.twig', [
            'user' => User::all()
        ]);
    }

    /**
     *
     * Check if username and password match entry in database
     *
     * @todo add encrypted passwords
     *
     * @return redirect to proper screen with proper flash message
     *
     */
    public function loginAction($request, $response, $params)
    {
        $params = $request->getParsedBody();
	$u = $params["username"];
	$p = $params["password"];

        $all = User::all();

	$a = 0;
	while ( $all[$a]["attributes"]["username"] ) {
	    if ( $all[$a]["attributes"]["username"] === $u ) {
	        if ( $all[$a]["attributes"]["password"] === $p ) {
		    $this->flash->addMessage('global', 'Valid Password');
                    $uri = $request->getUri()->withQuery('')->withPath($this->router->pathFor('welcome'));
                    return $response->withRedirect((string)$uri);
		} else {
	            $this->flash->addMessage('global', 'Not Valid, Try Again');
                    $uri = $request->getUri()->withQuery('')->withPath($this->router->pathFor('home'));
                    return $response->withRedirect((string)$uri);
	        }
	    }
	    $a++;
	}
        $this->flash->addMessage('global', 'Not Valid, Try Again');
        $uri = $request->getUri()->withQuery('')->withPath($this->router->pathFor('home'));
        return $response->withRedirect((string)$uri);
    }
}
