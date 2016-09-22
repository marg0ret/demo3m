<?php
namespace App\Action;

use Slim\Views\Twig;
use Psr\Log\LoggerInterface;
use Slim\Http\Request;
use Slim\Http\Response;

final class HomeAction
{
    private $view;
    private $logger;

    public function __construct(Twig $view, LoggerInterface $logger)
    {
        $this->view = $view;
        $this->logger = $logger;
    }

    public function __invoke(Request $request, Response $response, $args)
    {
        $this->logger->info("Home page action dispatched");
        
        $this->view->render($response, 'home.twig');
        return $response;
    }


    public function loginAction($request, $response, $params)
    {
        $usernm = User::find($params['username']);
        if (!$usernm) {
	    $this->flash->addMessage('message', 'Not Valid, Try Again');
            $uri = $request->getUri()->withQuery('')->withPath($this->router->pathFor('home'));
            return $response->withRedirect((string)$uri);
        }
        $errors = null;
        if ($request->isPost()) {
            if ($request->getAttribute('csrf_status') === false) {
                $errors['form'] = 'CSRF faiure';
            } else {
                $data = $request->getParsedBody();
                $validator = $author->getValidator($data);
                if ($validator->validate()) {
                    $author->update($data);
                    $this->flash->addMessage('message', 'Valid Password');
                    
                    $uri = $request->getUri()->withQuery('')->withPath($this->router->pathFor('author', ['author_id' => $author->id]));
                    return $response->withRedirect((string)$uri);
                } else {
                    $errors = $validator->errors();
                }
            }
        }
        return $this->view->render($response, 'bookshelf/author/edit.twig', [
            'author' => $author,
            'errors' => $errors,
            'csrf' => [
                        'name' => $request->getAttribute('csrf_name'),
                        'value' => $request->getAttribute('csrf_value'),
                      ],
        ]);
    }
}
