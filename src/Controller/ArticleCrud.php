<?php
declare(strict_types=1);

namespace SimpleMVC\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Helper\LoginAction;
use SimpleMVC\Model\ArticoloDb;


class ArticleCrud implements ControllerInterface {

    protected $plates;
    protected $login;
    protected $table;

    public function __construct(LoginAction $login, Engine $plates, ArticoloDb $table) {
        $this->plates = $plates;
        $this->login  = $login;
        $this->table  = $table;
    }

    public function execute(ServerRequestInterface $request)
    {
        // select case and execute query
    }

}