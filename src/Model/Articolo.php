<?php
declare(strict_types=1);
namespace SimpleMVC\Model;
class Articolo {
    private $id;
    private $titolo;
    private $contenuto;
    private $autore;
    private $data;
    
    public function __construct(int $id, string $titolo, string $contenuto, string $autore, string $data) {
        
        $this->id = $id;
        $this->titolo = $titolo;
        $this->contenuto = $contenuto;
        $this->autore = $autore;
        $this->setData($data);
    }
//TODO: check the lenght of each input (data already done)
    public function getId(): int{
        return $this->id;
    }
    public function getTitolo(): string{
        return $this->titolo;
    }
    
    public function setTitolo(string $titolo) {
        $this->titolo = $titolo;
    }
    public function getContenuto(): string{
        return $this->contenuto;
    }
    public function setContenuto(string $contenuto) {
        $this->contenuto = $contenuto;
    }
    public function getAutore(): string{
        return $this->autore;
    }
    public function setAutore(string $autore) {
        $this->autore = $autore;
    }
    public function getData(): string{
        return $this->data;
    }
    public function setData(string $data) {
        if(strtotime($data)){
            $this->data = $data;
        }else{
            throw new Exception('Incorect data');
        }
    }
}