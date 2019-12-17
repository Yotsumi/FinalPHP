<?php
declare(strict_types=1);

namespace SimpleMVC\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Helper\SessionHandle;
use SimpleMVC\Helper\LoginAction;
use SimpleMVC\Helper\RegexHelper;

// use SimpleMVC\Helper\CryptMsg;

class Dashboard implements ControllerInterface
{
    protected $login;
    protected $plates;

    public function __construct(Engine $plates, LoginAction $login) {
        $this->login = $login;
        $this->plates = $plates;
    }

    protected function getView(ServerRequestInterface $request) :array {
        $regexString = RegexHelper::setUrl('dashboard');
        $viewParam = '';
        if (preg_match($regexString, $request->getUri()->getPath(), $arres)){
            $viewParam = sprintf("%s", $arres[2]);
        }

        $args;
        $res = [];

        // articles
        if ($viewParam == 'addarticle') {
            $res =  ['addArticle', 'Add Article'];
        } elseif ($viewParam == 'listarticle') {
            $res =  ['articleList', 'Articles'];
        } elseif ($viewParam == 'modarticle') {
            $res =  ['modifyArticle', 'Edit Article'];

        // users
        } elseif ($viewParam == 'adduser') {
            $res =  ['addUser', 'Add User'];
        } elseif ($viewParam == 'listuser') {
            $res =  ['userList', 'Users'];
        } elseif ($viewParam == 'moduser') {
            $res =  ['modifyUser', 'Edit User'];
        // dashboard
        } else {
            $res =  ['dashboardMenu', 'Dashboard'];
        }
        $res[2] = $args;
        return $res;
    }

    public function execute(ServerRequestInterface $request)
    {
        if (true){ //$this->login->isLoggedIn()) {
            list($view, $title) = $this->getView($request);
            echo $this->plates->render('dashboard', 
                ['view' => $view, 'title' => $title ]);
            // get param to choose view to insert
        } else {
            $this->login->unlogUser(); // destroy session
            http_response_code(401);
            echo $this->plates->render('401');
        }
    }

}