<?php
declare(strict_types=1);
namespace SimpleMVC\Model;
use SimpleMVC\Model\Utente;
use PDO;
use PDOException;
class UtenteDb {
    public $pdo;

    public function __construct(\PDO $pdo){
        $this->pdo = $pdo;
    }

    public function selectFromUsername(string $username) :?array{
        $query = "SELECT * FROM utente WHERE username = :username;";
        $args = [':username' => $username];
        return $this->selectQueries($query, $args);
    }
    public function selectAllUsers() :?array{
        $query = "SELECT * FROM utente";
        $args = [];
        return $this->selectQueries($query, $args);
    }
    public function createUserByArray(array $args){
        $query = "INSERT INTO utente VALUES(:hashUtente, :username, :password, :abilitato)";
        return $this->insertQueries($query, $args);
    }
    public function createUserByDefault(string $hashUtente, string $username, string $password, bool $abilitato){
        $query = "INSERT INTO utente VALUES(:hashUtente, :username, :password, :abilitato)";
        $args = [':hashUtente' => $hashUtente, ':username' => $username, ':password' => $password, ':abilitato' => $abilitato];
        return $this->insertQueries($query, $args);
    }
    public function updateUser(string $findUsername, string $newHashUtente, string $newUsername, string $newPassword, bool $newAbilitato){
        $query = "UPDATE utente SET hashUtente = :hashUtente, username = :newUsername, password = :password, abilitato = :abilitato WHERE username = :username;";
        $args = [':hashUtente' => $newHashUtente, ':newUsername' => $newUsername, ':password' => $newPassword, ':abilitato' => (int)$newAbilitato, ':username' => $findUsername]; //new abilitato lo converto in int perchè nel db tale colonna è di tipo tinyInt
        return $this->updateQueries($query, $args);
    }
    private function selectQueries(string $query, array $args) :?array{
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
    private function insertQueries(string $query, array $args){
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
    private function updateQueries(string $query, array $args){
        try{
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sth = $this->pdo->prepare($query);
            $sth->execute($args);

        }catch(PDOException $e){
            return $e->getMessage();
        }
    }
    public function deleteUser($username){
        try{
            $query = "DELETE FROM utente WHERE username = :username";
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $sth = $this->pdo->prepare($query);
            $sth->execute([
                ':username' => $username
            ]);

        }catch(PDOException $e){
            return $e->getMessage();
        }
    }
}