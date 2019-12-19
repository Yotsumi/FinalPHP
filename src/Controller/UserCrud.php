<?php
declare(strict_types=1);

namespace SimpleMVC\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Helper\LoginAction;
use SimpleMVC\Model\UtenteDb;
use SimpleMVC\Helper\HashMsg;

class UserCrud extends AbstractCrud {
    protected $hash;

    public function __construct(LoginAction $login, Engine $plates, UtenteDb $table, HashMsg $hash) {
        $this->plates = $plates;
        $this->login  = $login;
        $this->table  = $table;
        $this->hash = $hash;
    }
    protected function create(){
        try{
            $this->table->createRecord([
                ':username' => $_POST['crudUsername'],
                ':password' => $this->hash->hash($_POST['crudPassword']),
                ':abilitato' => true,
                ':hashUtente' => md5($_POST['crudUsername'])
            ]);
        }catch(PDOException $e){
            echo '<script>alert("Errore creazione utente"); location.href = "http://'.$_SERVER["HTTP_HOST"].'/dashboard"</script>';
            exit;
        }
        header('Location: http://'.$_SERVER["HTTP_HOST"]. '/dashboard');
        exit;
    }

    protected function update(){
        try{
            $username = $_POST['oldUsername'];
            $this->table->updateRecordById([
                ':newUsername' => $_POST['crudUsername'],
                ':password' => $this->hash->hash($_POST['crudPassword']),
                ':abilitato' => $_POST['attivo'],
                ':hashUtente' => md5($_POST['crudUsername']),
                ':username' => $username
            ]);
        }catch(PDOException $e){
            echo '<script>alert("Errore creazione utente"); location.href = "http://'.$_SERVER["HTTP_HOST"].'/dashboard"</script>';
            exit;
        }
        header('Location: http://'.$_SERVER["HTTP_HOST"]. '/dashboard');
        exit;
    }

    protected function delete(){
        try{
            $this->table->deleteRecordById([
                ':username' => $_POST['usernameCrud'],
            ]);
        }catch(PDOException $e){
            echo '<script>alert("Errore creazione utente"); location.href = "http://'.$_SERVER["HTTP_HOST"].'/dashboard"</script>';
            exit;
        }
        header('Location: http://'.$_SERVER["HTTP_HOST"]. '/dashboard');
        exit;
    }

}