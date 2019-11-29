<?php
declare(strict_types=1);

namespace SimpleMVC\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Helper\SessionHandle;

class Login implements ControllerInterface
{
    protected $plates;
    protected $session;

    public function __construct(Engine $plates, SessionHandle $session)
    {
        $this->session = $session;
        $this->plates = $plates;
    }

    public function execute(ServerRequestInterface $request)
    {
        echo $this->plates->render('login');
        $this->session->close();
    }
}
