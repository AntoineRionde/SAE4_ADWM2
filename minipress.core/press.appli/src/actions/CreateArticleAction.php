<?php

namespace press\app\actions;

use press\app\services\categories\CategorieService;
use press\app\services\user\AccessControlException;
use press\app\services\user\UserService;
use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Routing\RouteContext;
use Slim\Views\Twig;
use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;

class CreateArticleAction extends AbstractAction
{

    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $routeParser = RouteContext::fromRequest($request)->getRouteParser();

        if (!isset($_SESSION['user'])){
            $_SESSION['error'] = "Vous devez être connecté pour créer un article";
            $urlLogin = $routeParser->urlFor('login', [], ['target' => 'createArticle']);
            return $response->withHeader('location', $urlLogin)->withStatus(302);
        }

        $error = $_SESSION['error'] ?? "";
        unset($_SESSION['error']);

        $view = Twig::fromRequest($request);
        $categService = new CategorieService();
        $categories = $categService->getCategories();
        return $view->render($response, 'createArticle.twig', ['categories' => $categories, 'user' => $_SESSION['user'], 'error' => $error]);
    }
}