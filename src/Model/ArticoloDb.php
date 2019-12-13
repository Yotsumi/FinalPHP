<?php
declare(strict_types=1);
namespace SimpleMVC\Model;
class ArticoloDb {
    //SELECT ALL() LIMITE DI 200 CARATTERI PER IL CONTENUTO

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
}