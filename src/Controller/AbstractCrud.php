<?php
declare(strict_types=1);

namespace SimpleMVC\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Helper\LoginAction;
use SimpleMVC\Model\ArticoloDb;


abstract class AbstractCrud implements ControllerInterface {

    protected $plates;
    protected $login;
    protected $table;

    public function __construct(LoginAction $login, Engine $plates, ArticoloDb $table) {
        $this->plates = $plates;
        $this->login  = $login;
        $this->table  = $table;
    }

    protected function getCrudAction(ServerRequestInterface $request) :string {
        $regexString = RegexHelper::setUrl('dashboard');
        $action = '';
        if (preg_match($regexString, $request->getUri()->getPath(), $arres)){
            $action = sprintf("%s", $arres[2]);
        }
        return $action;
    }

    abstract protected function create();
    abstract protected function update();
    abstract protected function delete();

    public function execute(ServerRequestInterface $request)
    {
        $action = $this->getCrudAction($request);
        if ($action == 'c') {
            $this->create();
        } elseif ($action == 'u') {
            $this->update();
        } elseif ($action == 'd') {
            $this->delete();
        }
    }
}