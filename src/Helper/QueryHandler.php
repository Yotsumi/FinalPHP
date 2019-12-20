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
            $sth->setFetchMode(PDO::FETCH_CLASS, $type);
            $obj = $sth->fetchAll();
            return $obj;
        } catch(Exception $e) {
            return null;
        }
    }

    protected function postQueries(string $query, array $args){
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $sth = $this->pdo->prepare($query);
        $sth->execute($args);
    }
}