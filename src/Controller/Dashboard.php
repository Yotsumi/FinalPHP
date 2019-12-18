<?php
declare(strict_types=1);

namespace SimpleMVC\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Helper\SessionHandle;
use SimpleMVC\Helper\LoginAction;
use SimpleMVC\Helper\RegexHelper;

class Dashboard implements ControllerInterface
{
    protected $login;
    protected $plates;

    public function __construct(Engine $plates, LoginAction $login) {
        $this->login = $login;
        $this->plates = $plates;
    }

    public function execute(ServerRequestInterface $request)
    {
        if ($this->login->isLoggedIn()) {
            $title = 'Dashboard';
            echo $this->plates->render('dashboardMenu', 
                ['title' => $title ]);
            // get param to choose view to insert
        } else {
            $this->login->unlogUser(); // destroy session
            http_response_code(401);
            echo $this->plates->render('401');
        }
    }

}