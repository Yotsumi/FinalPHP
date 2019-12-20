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
        $pwd = $this->post['crudPassword'];
        if (! hash_equals($this->post['oldPassword'], $this->post['crudPassword'])) {
            $pwd = HashMsg::hash($this->post['crudPassword']);
        }
        return $pwd;
    }

    protected function create(){
        var_dump($this->post);
       // die();
        try{
            $this->table->createRecord([
                ':username'  => $this->post['crudUsername'],
                ':password'  => HashMsg::hash($this->post['crudPassword']),
                ':abilitato' => 0,
                ':hashUtente' => md5($this->post['crudUsername'])
            ]);
        }catch(\PDOException $e){
            var_dump($e->getMessage());
            echo '<script>alert("Errore creazione utente"); location.href = "'.'/dashboard"</script>';
            exit;
        }
        header('Location: '. "/$this->redirect" );
        exit;
    }

    protected function update(){
        $pwd = $this->getPwd();
        try{
            $username = $this->post['oldUsername'];
            $this->table->updateRecordById([
                ':newUsername' => $this->post['crudUsername'],
                ':password' => $pwd,
                ':abilitato' => (int)$this->post['attivo'],
                ':hashUtente' => md5($this->post['crudUsername']),
                ':username' => $username
            ]);
        }catch(\PDOException $e){
            echo '<script>alert("Errore creazione utente"); location.href = "'.'/dashboarduser"</script>';
            exit;
        }
        header('Location: '. "/$this->redirect");
        exit;
    }

    protected function delete(){
        try{
            $this->table->deleteRecordById([
                ':username' => $this->post['crudUsername'],
            ]);
        }catch(\PDOException $e){
            echo '<script>alert("Errore creazione utente"); location.href = "'.'/dashboarduser"</script>';
            exit;
        }
        header('Location: '. "/$this->redirect");
        exit;
    }

}