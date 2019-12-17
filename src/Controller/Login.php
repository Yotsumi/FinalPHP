<?php
declare(strict_types=1);

namespace SimpleMVC\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Helper\SessionHandle;
use SimpleMVC\Helper\LoginAction;


class Login implements ControllerInterface
{
    protected $plates;
    protected $session;
    protected $login;

    public function __construct(Engine $plates, SessionHandle $session, LoginAction $login)
    {
        $this->session = $session;
        $this->plates = $plates;
        $this->login = $login;
    }

    public function execute(ServerRequestInterface $request)
    {
        if (! $this->login->isLoggedIn()) {
            echo $this->plates->render('login');
            $this->session->close();
        } else {
            echo $this->plates->render('dashboardMenu');
            $this->session->close();
        }
       
    }
}
