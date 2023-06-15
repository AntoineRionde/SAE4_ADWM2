<?php

use press\app\actions\GetArticleAction;
use press\app\actions\GetCategoriesAction;
use press\app\actions\GetHomeAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;

return function (\Slim\App $app): void {
    /**
    $app->get('/', function (Request $request, Response $response, array $args) {
        $response->getBody()->write("Salut à tous!");
        return $response;
    });*/

    $app->get('/', GetHomeAction::class)->setName('home');
    $app->get('/articles[/]', GetArticleAction::class)->setName("articles");
    $app->get('/categories[/]', GetCategoriesAction::class)->setName("categories");
    
};