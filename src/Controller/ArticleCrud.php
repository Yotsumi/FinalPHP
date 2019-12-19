<?php
declare(strict_types=1);

namespace SimpleMVC\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Helper\LoginAction;
use SimpleMVC\Model\ArticoloDb;


class ArticleCrud extends AbstractCrud {

    protected $redirect = 'dashboardarticle';

    public function __construct(LoginAction $login, Engine $plates, ArticoloDb $table) {
        $this->plates = $plates;
        $this->login  = $login;
        $this->table  = $table;

        // check for permissions
        if (! $this->login->isLoggedIn()) {
            http_response_code(401);
            echo $this->plates->render('401');
            die();
        }
    }

    protected function create(){
        try{
            $this->table->createRecord([
                ':titolo' => str_replace('-', ' ', $_POST['title']),
                ':data' => $_POST['data'],
                ':contenuto' => $_POST['content'],
                ':autore' => $_POST['author']
            ]);
        }catch(\PDOException $e){
            echo '<script>alert("Errore inserimento articolo"); location.href = "http://'.$_SERVER["HTTP_HOST"].'/dashboard"</script>';
            exit;
        }
        header('Location: http://'.$_SERVER["HTTP_HOST"]. "/$this->redirect");
        exit;
    }

    protected function update(){
        try{
            $this->table->updateRecordById([
                ':id' => $_POST['id'],
                ':titolo' => $_POST['title'],
                ':data' => $_POST['data'],
                ':contenuto' => $_POST['content'],
                ':autore' => $_POST['author']
            ]);
        }catch(\PDOException $e){
            echo '<script>alert("Errore modifica articolo"); location.href = "http://'.$_SERVER["HTTP_HOST"].'/dashboardarticle"</script>';
            exit;
        }
        header('Location: http://'.$_SERVER["HTTP_HOST"]. "/$this->redirect");
        exit;
    }

    protected function delete(){
        try{
            $this->table->deleteRecordById([
                ':id' => $_POST['id']
            ]);
        }catch(\PDOException $e){
            echo '<script>alert("Errore eliminazione articolo"); location.href = "http://'.$_SERVER["HTTP_HOST"].'/dashboardarticle"</script>';
            exit;
        }
        header('Location: http://'.$_SERVER["HTTP_HOST"]. "/$this->redirect");
        exit;
    }

}