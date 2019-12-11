<?php
declare(strict_types=1);
namespace SimpleMVC\Model;
class Utente {
    private $username;
    private $password;
    private $abilitato;
    private $hashUtente;
    
    public function __construct(int $username, string $password, string $abilitato, string $hashUtente) {
        
        $this->username = $username;
        $this->password = $password;
        $this->abilitato = $abilitato;
        $this->hashUtente = $hashUtente;
    }
//TODO: check the lenght of each input (data already done)
    public function getUsername(): string{
        return $this->username;
    }
    public function setUsername(string $username) {
        $this->username = $username;
    }
    public function getPassword(): string{
        return $this->password;
    }
    public function setPassword(string $password) {
        $this->password = $password;
    }
    public function getAbilitato(): bool{
        return $this->contenuto;
    }
    public function setAbilitato(bool $abilitato) {
        $this->abilitato = $abilitato;
    }
    public function getHashUtente(): string{
        return $this->hashUtente;
    }
    public function setHashUtente(string $hashUtente) {
        $this->hashUtente = $hashUtente;
    }

}