<?php
declare(strict_types=1);

namespace SimpleMVC\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Helper\LoginAction;
use SimpleMVC\Model\ArticoloDb;


class ArticleCrud extends AbstractCrud {

    public function __construct(LoginAction $login, Engine $plates, ArticoloDb $table) {
        $this->plates = $plates;
        $this->login  = $login;
        $this->table  = $table;
    }

    protected function create(){
        var_dump($_POST);
        exit;
    }

    protected function update(){

    }

    protected function delete(){

    }

}