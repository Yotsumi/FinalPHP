<?php
declare(strict_types=1);
namespace SimpleMVC\Model;
use SimpleMVC\Helper\QueryHandler;

class ArticoloDb extends QueryHandler implements DbInterface {
    //SELECT ALL() LIMITE DI 200 CARATTERI PER IL CONTENUTO

    // rinomina: selectByKey(string ...$key) :?array
    public function selectFromTitle(string $title) :?object{
        try
        {
            $query = "SELECT * FROM articolo WHERE titolo = :titolo;";
            $sth = $pdo->prepare($query);
            $sth->execute([
                ':titolo'=> $titolo
            ]);
            $articolo = $sth->fetch(PDO::FETCH_OBJ);  //altro modo (da verificare)fetchObject("Articolo");
            return $articolo;
        }catch(Exception $e){
            printf("Errore: %s\n", $e->getMessage());
        }
    }

    // perfetto: selectAll()
    public function selectAll() :?array{
        $query = "SELECT * FROM articolo";
        $args = [];
        return $this->selectQueries($query, $args);
    }
}