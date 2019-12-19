<?php
declare(strict_types=1);

namespace SimpleMVC\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Helper\LoginAction;
use SimpleMVC\Model\ArticoloDb;
use PDOException;


class ArticleCrud extends AbstractCrud {

    public function __construct(LoginAction $login, Engine $plates, ArticoloDb $table) {
        $this->plates = $plates;
        $this->login  = $login;
        $this->table  = $table;
    }

    protected function create(){
        try{
            $this->table->createRecord([
                ':titolo' => $_POST['title'],
                ':data' => $_POST['data'],
                ':contenuto' => $_POST['content'],
                ':autore' => $_POST['author']
            ]);
        }catch(PDOException $e){
            echo '<script>alert("Errore inserimento articolo"); location.href = "http://'.$_SERVER["HTTP_HOST"].'/dashboard"</script>';
            exit;
        }
        echo 'Funzia';
        header('Location: http://'.$_SERVER["HTTP_HOST"]. '/dashboard');
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
        }catch(PDOException $e){
            echo '<script>alert("Errore modifica articolo"); location.href = "http://'.$_SERVER["HTTP_HOST"].'/dashboard"</script>';
            exit;
        }
        echo 'Funzia';
        header('Location: http://'.$_SERVER["HTTP_HOST"]. '/dashboard');
        exit;
    }

    protected function delete(){
        try{
            $this->table->deleteRecordById([
                ':id' => $_POST['id']
            ]);
        }catch(PDOException $e){
            echo '<script>alert("Errore eliminazione articolo"); location.href = "http://'.$_SERVER["HTTP_HOST"].'/dashboard"</script>';
            exit;
        }
        echo 'Funzia';
        header('Location: http://'.$_SERVER["HTTP_HOST"]. '/dashboard');
        exit;
    }

}