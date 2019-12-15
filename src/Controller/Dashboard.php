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

        // articles
        if ($viewParam == 'addarticle') {
            return ['addArticle', 'Add Article'];
        } elseif ($viewParam == 'listarticle') {
            return ['articleList', 'Articles'];
        } elseif ($viewParam == 'modarticle') {
            return ['modifyArticle', 'Edit Article'];

        // users
        } elseif ($viewParam == 'adduser') {
            return ['addUser', 'Add User'];
        } elseif ($viewParam == 'listuser') {
            return ['userList', 'Users'];
        } elseif ($viewParam == 'moduser') {
            return ['modifyUser', 'Edit User'];
        
        // dashboard
        } else {
            return ['dashboardMenu', 'Dashboard'];
        }
    }

    public function execute(ServerRequestInterface $request)
    {
        if (true){ //$this->login->isLoggedIn()) {
            $view = $this->getView($request);
            echo $this->plates->render('dashboard', 
                ['view' => $view[0], 'title' => $view[1] ]);
            // get param to choose view to insert
        } else {
            $this->login->unlogUser(); // destroy session
            http_response_code(401);
            echo $this->plates->render('401');
        }
    }

}