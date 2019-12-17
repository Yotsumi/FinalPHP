<?php
use SimpleMVC\Controller;

return [
    'GET /' => Controller\Home::class, // "SimpleMVC\Controller\Home"
    'GET /login' => Controller\Login::class,
    'POST /enter' => Controller\Enter::class,
    'GET /article' => Controller\Article::class,
    'GET /dashboard' => Controller\Dashboard::class,
    'GET /dashboardarticle' => Controller\DashboardArticle::class,
    'GET /dashboarduser' => Controller\DashboardUtente::class,
    'POST /utentecrud' => Controller\UserCrud::class,
    'POST /articlecrud' => Controller\ArticleCrud::class,
];
