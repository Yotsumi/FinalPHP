<?php
declare(strict_types=1);
namespace SimpleMVC\Helper;
use PDO;
use PDOException;

class QueryHandler {
    protected $pdo;

    public function __construct(\PDO $pdo){
        $this->pdo = $pdo;
    }

    protected function selectQueries(string $query, array $args, string $type) :?array{
        try
        {
            $sth = $this->pdo->prepare($query);
            $sth->execute($args);
// var_dump($query, $args, $type);
            $sth->setFetchMode(PDO::FETCH_CLASS, $type);
//var_dump($sth);
            $obj = $sth->fetchAll();
            return $obj;
        }catch(Exception $e){
            //printf("Errore: %s\n", $e->getMessage());
            return null;
        }
    }

    protected function postQueries(string $query, array $args){
        try
        {
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sth = $this->pdo->prepare($query);
            $sth->execute($args);
        }catch(PDOException $e){
            //printf("Errore: %s\n", $e->getMessage());
            return $e->getMessage();
        }
    }
}