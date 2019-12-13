<?php
use SimpleMVC\Controller;

return [
    'GET /' => Controller\Home::class, // "SimpleMVC\Controller\Home"
    'GET /login' => Controller\Login::class,
    'POST /enter' => Controller\Enter::class,
    'GET /article' => Controller\Article::class,
    'GET /dashboard' => Controller\Dashboard::class,
    'POST /utentecrud' => Controller\UtenteCrud::class,
    'POST /articlecrud' => Controller\ArticleCrud::class,
];
