<?php
declare(strict_types=1);
namespace SimpleMVC\Model;
use SimpleMVC\Model\Utente;
use SimpleMVC\Helper\QueryHandler;
use PDO;
use PDOException;

class UtenteDb extends QueryHandler implements DbInterface {
    
    public function __construct(\PDO $pdo){
        parent::__construct($pdo);
    }

    // rinomina: selectByKey(string ...$key) :?array
    public function selectFromUsername(string $username) :?array{ 
        $query = "SELECT * FROM utente WHERE username = :username;";
        $args = [':username' => $username];
        return $this->selectQueries($query, $args);
    }

    // rinomina: selectAll() :?array;
    public function selectAllUsers() :?array{ 
        $query = "SELECT * FROM utente";
        $args = [];
        return $this->selectQueries($query, $args);
    }

    // rinomina: createRecord(...$data) 
    public function createUserByArray(array $args){
        $query = "INSERT INTO utente VALUES(:hashUtente, :username, :password, :abilitato)";
        return $this->insertQueries($query, $args);
    }

    // remove ->
    public function createUserByDefault(string $hashUtente, string $username, string $password, bool $abilitato){
        $query = "INSERT INTO utente VALUES(:hashUtente, :username, :password, :abilitato)";
        $args = [':hashUtente' => $hashUtente, ':username' => $username, ':password' => $password, ':abilitato' => $abilitato];
        return $this->insertQueries($query, $args);
    }

    // rinomina: updateRecord(string ...$data)
    public function updateUser(string $findUsername, string $newHashUtente, string $newUsername, string $newPassword, bool $newAbilitato){
        $query = "UPDATE utente SET hashUtente = :hashUtente, username = :newUsername, password = :password, abilitato = :abilitato WHERE username = :username;";
        $args = [':hashUtente' => $newHashUtente, ':newUsername' => $newUsername, ':password' => $newPassword, ':abilitato' => (int)$newAbilitato, ':username' => $findUsername]; //new abilitato lo converto in int perchè nel db tale colonna è di tipo tinyInt
        return $this->updateQueries($query, $args);
    }
    
    // rinomina: deleteRecord(string ...$key)
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