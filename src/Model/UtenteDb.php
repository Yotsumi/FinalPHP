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
    public function selectByKey(array $key) :?array{ 
        $query = "SELECT * FROM utente WHERE username = :username;";
        return $this->selectQueries($query, $key, Utente::class);
    }

    // rinomina: selectAll() :?array;
    public function selectAll() :?array{ 
        $query = "SELECT * FROM utente";
        return $this->selectQueries($query, [], Utente::class);
    }

    // rinomina: createRecord(...$data) 
    public function createRecord(array $data){
        
        $query = "INSERT INTO utente VALUES(:hashUtente, :username, :password, :abilitato)";
        return $this->postQueries($query, $data);
    }

    // remove ->
    /*public function createUserByDefault(string $hashUtente, string $username, string $password, bool $abilitato){
        $query = "INSERT INTO utente VALUES(:hashUtente, :username, :password, :abilitato)";
        $args = [':hashUtente' => $hashUtente, ':username' => $username, ':password' => $password, ':abilitato' => $abilitato];
        return $this->insertQueries($query, $args);
    }
*/
    // rinomina: updateRecord(string ...$data)
    public function updateRecordById(array $data){
        $query = "UPDATE utente SET hashUtente = :hashUtente, username = :newUsername, password = :password, abilitato = :abilitato WHERE username = :username;";
        //$args = [':hashUtente' => $newHashUtente, ':newUsername' => $newUsername, ':password' => $newPassword, ':abilitato' => (int)$newAbilitato, ':username' => $findUsername]; //new abilitato lo converto in int perchè nel db tale colonna è di tipo tinyInt
        return $this->postQueries($query, $data);
    }
    
    // rinomina: deleteRecord(string ...$key)
    public function deleteRecordById(array $data){
        $query = "DELETE FROM utente WHERE username = :username";
        return $this->postQueries($query, $data);
    }
}