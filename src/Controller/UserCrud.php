<?php
declare(strict_types=1);

namespace SimpleMVC\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Helper\LoginAction;
use SimpleMVC\Model\UtenteDb;


class UserCrud extends AbstractCrud {

    public function __construct(LoginAction $login, Engine $plates, UtenteDb $table) {
        $this->plates = $plates;
        $this->login  = $login;
        $this->table  = $table;
    }

    protected function create(){
        $this->table->createRecord($data);
    }

    protected function update(){

    }

    protected function delete(){

    }

}