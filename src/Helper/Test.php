<?php

namespace SimpleMVC\Helper;

use PDO;

class Test{

    private $pdo;

    public function __construct(PDO $pdo) {
        $this->pdo = $pdo;
    }

    public function TEST(){

        return var_dump($this->pdo);
        
    }

}