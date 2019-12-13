<?php
use SimpleMVC\Controller;

return [
    'GET /' => Controller\Home::class, // "SimpleMVC\Controller\Home"
    'GET /login' => Controller\Login::class,
    'POST /enter' => Controller\Enter::class,
    'GET /article' => Controller\Article::class,
    'GET /dashboard' => Controller\Dashboard::class
];
