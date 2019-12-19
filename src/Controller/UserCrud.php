<?php
declare(strict_types=1);

namespace SimpleMVC\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Helper\LoginAction;
use SimpleMVC\Model\UtenteDb;
use SimpleMVC\Helper\HashMsg;

class UserCrud extends AbstractCrud {
    protected $redirect = 'dashboarduser';

    public function __construct(LoginAction $login, Engine $plates, UtenteDb $table) {
        $this->plates = $plates;
        $this->login  = $login;
        $this->table  = $table;

        // check for permissions
        if (! $this->login->isLoggedIn() || !$this->login->getIsAdmin()) {
            http_response_code(401);
            echo $this->plates->render('401');
            die();
        }
    }

    // check if password needs hashing
    protected function getPwd() :string {
        $pwd = $_POST['crudPassword'];
        if (! hash_equals($_POST['oldPassword'], $_POST['crudPassword'])) {
            $pwd = HashMsg::hash($_POST['crudPassword']);
        }
        return $pwd;
    }

    protected function create(){
        try{
            $this->table->createRecord([
                ':username'  => $_POST['crudUsername'],
                ':password'  => HashMsg::hash($_POST['crudPassword']),
                ':abilitato' => false,
                ':hashUtente' => md5($_POST['crudUsername'])
            ]);
        }catch(\PDOException $e){
            echo '<script>alert("Errore creazione utente"); location.href = "http://'.$_SERVER["HTTP_HOST"].'/dashboard"</script>';
            exit;
        }
        header('Location: http://'.$_SERVER["HTTP_HOST"]. "/$this->redirect" );
        exit;
    }

    protected function update(){
        $pwd = $this->getPwd();
        try{
            $username = $_POST['oldUsername'];
            $this->table->updateRecordById([
                ':newUsername' => $_POST['crudUsername'],
                ':password' => $pwd,
                ':abilitato' => $_POST['attivo'],
                ':hashUtente' => md5($_POST['crudUsername']),
                ':username' => $username
            ]);
        }catch(\PDOException $e){
            echo '<script>alert("Errore creazione utente"); location.href = "http://'.$_SERVER["HTTP_HOST"].'/dashboarduser"</script>';
            exit;
        }
        header('Location: http://'.$_SERVER["HTTP_HOST"]. "/$this->redirect");
        exit;
    }

    protected function delete(){
        try{
            $this->table->deleteRecordById([
                ':username' => $_POST['crudUsername'],
            ]);
        }catch(\PDOException $e){
            echo '<script>alert("Errore creazione utente"); location.href = "http://'.$_SERVER["HTTP_HOST"].'/dashboarduser"</script>';
            exit;
        }
        header('Location: http://'.$_SERVER["HTTP_HOST"]. "/$this->redirect");
        exit;
    }

}