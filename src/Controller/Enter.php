<?php
declare(strict_types=1);

namespace SimpleMVC\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Helper\SessionHandle;
use SimpleMVC\Helper\LoginAction;

use SimpleMVC\Helper\CryptMsg;

class Enter implements ControllerInterface
{
    protected $plates;
    protected $login;

    public function __construct(Engine $plates, LoginAction $login)
    {
        $this->login = $login;
        $this->plates = $plates;
    }

    public function execute(ServerRequestInterface $request)
    {
        // exec login logics
        $username = addslashes(filter_var($_POST['user'], FILTER_SANITIZE_STRING));//$_POST['user'];
        $password = $_POST['pwd'];

        if ($this->login->loginUser($username, $password)) {
            echo $this->plates->render('dashboardMenu',
            ['title' => 'Dashboard' ]); 
        } else {
            http_response_code(401);
            echo $this->plates->render('401');
        }
    }
}