<?php
declare(strict_types=1);
namespace SimpleMVC\Model;
class Utente {
    private $username;
    private $password;
    private $abilitato;
    private $hashUtente;
    
    public function __construct() {
        
    }
    
    public static function arrayConstruct(array $data){
        $instance = new self();
        $instance->loadWithArray($data);
        return $instance;
    }
    public static function defaultConstruct(string $username, string $password, bool $abilitato, string $hashUtente){
        $instance = new self();
        $instance->loadDefault($username,$password,$abilitato,$hashUtente);
        return $instance;
    }
    private function loadWithArray($data){
        if(count($data) > 0){
            $this->setByArray($data);
            return;
        }
    }
    private function loadDefault(string $username, string $password, bool $abilitato, string $hashUtente){
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
    private function setByArray(array $data){
        //TODO: CHECK THAT ALL THE ELEMENTS ARE PASSED.
        $this->setHashUtente($data['hashUtente']);
        $this->setUsername($data['username']);
        $this->setPassword($data['password']);
        $this->setAbilitato(filter_var($data['abilitato'], FILTER_VALIDATE_BOOLEAN));
    }

}