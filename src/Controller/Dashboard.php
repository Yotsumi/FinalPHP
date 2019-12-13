<?php
declare(strict_types=1);

namespace SimpleMVC\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Helper\SessionHandle;
use SimpleMVC\Helper\LoginAction;
use SimpleMVC\Helper\RegexHelper;

// use SimpleMVC\Helper\CryptMsg;

class Enter implements ControllerInterface
{
    protected $login;
    protected $plates;

    public function __construct(Engine $plates, LoginAction $login) {
        $this->login = $login;
        $this->plates = $plates;
    }

    protected function getView() :string {
        RegexHelper::setUrl('dashboard');
    }

    public function execute(ServerRequestInterface $request)
    {
        if ($this->login->isLoggedIn()) {
            echo $this->plates->render($url);
            // get param to choose view to insert
        } else {
            $this->login->unlogUser(); // destroy session
            http_response_code(401);
            echo $this->plates->render('401');
        }
    }

}