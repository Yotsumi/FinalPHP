<?php
declare(strict_types=1);

namespace SimpleMVC\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Model\UtenteDb;
use SimpleMVC\Model\Utente;
use SimpleMVC\Helper\RegexHelper;

class DashboardUser implements ControllerInterface
{
    protected $plates;
    protected $table;


    public function __construct(Engine $plates, UtenteDb $table)
    {
        $this->plates = $plates;
        $this->table = $table;
    }

    protected function getView(ServerRequestInterface $request) :array {
        $regexString = RegexHelper::setUrl('dashboarduser');
        $viewParam = '';
        if (preg_match($regexString, $request->getUri()->getPath(), $arres)){
            $viewParam = sprintf("%s", $arres[2]);
        }

        $args;
        $res = [];

        // articles
        if (strlen($viewParam) < 1) {
            $res =  ['userList', 'Users'];
            $args = $this->table->selectAll();

        } elseif ($viewParam == 'adduser') {
            $res =  ['addUser', 'Add User'];

        } else {
            $args = $this->table->selectByKey([':username' => $viewParam]);
            $res =  ['modifyUser', 'Edit User'];
        } 

        array_push($res, $args);
        return $res;
    }


    public function execute(ServerRequestInterface $request)
    {
        $view = $this->getView($request);
        echo $this->plates->render($view[0], [
            'title' => $view[1],
            'args' => $view[2]
        ]);
    }
}