<?php
declare(strict_types=1);
namespace SimpleMVC\Model;
use SimpleMVC\Model\Utente;
use \PDO;
class UtenteDb {
    public $pdo;

    public function __construct(\PDO $pdo){
        $this->pdo = $pdo;
    }

    public function selectFromUsername(string $username) :?array{
        try
        {
            $query = "SELECT * FROM utente WHERE username = :username;";
            $sth = $this->pdo->prepare($query);
            $sth->execute([
                ':username'=> $username
            ]);
            //sth->setFetchMode(PDO::FETCH_CLASS, 'Utente');
            $utente = $sth->fetch(PDO::FETCH_ASSOC);
            //conecrtire da Obj a Utente

            return $utente;
        }catch(Exception $e){
            printf("Errore: %s\n", $e->getMessage());
        }
    }
}