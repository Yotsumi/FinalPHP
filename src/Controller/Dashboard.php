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

    protected function getView(ServerRequestInterface $request) :string {
        $regexString = RegexHelper::setUrl('dashboard');
        $view = '';
        if (preg_match($regexString, $request->getUri()->getPath(), $arres)){
            $view = sprintf("%s", $arres[2]);
        }
        if ($view == 'newArticle') {
            // return ...
        } else {
            return 'dashboardMenu';
        }
    }

    public function execute(ServerRequestInterface $request)
    {
        if (true){ //$this->login->isLoggedIn()) {
            $view = getView($request);
            echo $this->plates->render('dashboard', ['view' => $view]);
            // get param to choose view to insert
        } else {
            $this->login->unlogUser(); // destroy session
            http_response_code(401);
            echo $this->plates->render('401');
        }
    }

}