<?php
use SimpleMVC\Controller;

return [
    'GET /' => Controller\Home::class, // "SimpleMVC\Controller\Home"
    'GET /login' => Controller\Login::class,
    'POST /logout' => Controller\Logout::class,
    'POST /enter' => Controller\Enter::class,
    'GET /article' => Controller\Article::class,
    'GET /dashboard' => Controller\Dashboard::class,
    'GET /dashboardarticle' => Controller\DashboardArticle::class,
    'GET /dashboarduser' => Controller\DashboardUser::class,
    'POST /usercrud' => Controller\UserCrud::class,
    'POST /articlecrud' => Controller\ArticleCrud::class,
];
