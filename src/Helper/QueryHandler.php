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

    protected function selectQueries(string $query, array $args) :?array{
        try
        {
            $sth = $this->pdo->prepare($query);
            $sth->execute($args);
            $sth->setFetchMode(PDO::FETCH_CLASS, Utente::class);
            $utente = $sth->fetchAll();
            return $utente;
        }catch(Exception $e){
            //printf("Errore: %s\n", $e->getMessage());
            return null;
        }
    }

    protected function insertQueries(string $query, array $args){
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

    protected function updateQueries(string $query, array $args){
        try{
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sth = $this->pdo->prepare($query);
            $sth->execute($args);

        }catch(PDOException $e){
            return $e->getMessage();
        }
    }
}