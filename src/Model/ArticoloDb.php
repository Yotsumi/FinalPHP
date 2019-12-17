<?php
declare(strict_types=1);
namespace SimpleMVC\Model;
use SimpleMVC\Helper\QueryHandler;

class ArticoloDb extends ArticoloClient implements DbInterface {
    //SELECT ALL() LIMITE DI 200 CARATTERI PER IL CONTENUTO

    // rinomina: selectByKey(string ...$key) :?array
    public function createRecord(array $data){
        $query = "INSERT INTO articolo VALUES(:id, :titolo, :contenuto, :autore, :data)";
        $this->postQueries($query, $data);
    }
    public function updateRecordById(array $data){
        $query = "UPDATE articolo SET titolo = :titolo, contenuto = :contenuto, autore = :autore, data = :data WHERE id = :id";
        $this->postQueries($query, $data);
    }
    public function deleteRecordById(array $data){
        $query = "DELETE FROM articolo WHERE id = :id";
        $this->postQueries($query, $data);
    } 
}