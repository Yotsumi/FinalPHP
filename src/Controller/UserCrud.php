<?php
declare(strict_types=1);

namespace SimpleMVC\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Helper\LoginAction;
use SimpleMVC\Model\UserDb;


class UserCrud extends AbstractCrud {

    protected function create(){
        $this->table->createUserByDefault(string $hashUtente, string $username, string $password, bool $abilitato)
    }

    protected function update(){

    }

    protected function delete(){

    }

}