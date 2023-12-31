<?php

namespace press\app\actions;

use Slim\Psr7\Request;
use Slim\Psr7\Response;
use Slim\Views\Twig;

class GetHomeAction extends AbstractAction
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE)
            session_start();
    }

    public function __invoke(Request $request, Response $response, array $args): Response
    {
        $error = $_SESSION['error'] ?? "";
        unset($_SESSION['error']);

        $view = Twig::fromRequest($request);
        $view->render($response, 'home.twig', ['user' => $_SESSION['user'] ?? null, 'error' => $error]);
        return $response;
    }
}