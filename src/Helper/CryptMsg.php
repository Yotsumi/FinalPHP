<?php
declare(strict_types=1);

namespace SimpleMVC\Helper;

class CryptMsg {

    protected $sessionKeyFile = '/config/sessionKey.key';
    protected $key = '';
    protected $nonce;
    
    public function __construct(string $nonce) {
        $this->sessionKeyFile = dirname(__DIR__ ,2) . $this->sessionKeyFile; 

        if (! file_exists($this->sessionKeyFile)) {
            touch($this->sessionKeyFile);
        }
        $this->key = file_get_contents($this->sessionKeyFile);
        $this->key = $this->key === false ? '' : $this->key;

        if (strlen($this->key) < 1) {
            $this->key = base64_encode(random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES));
            file_put_contents($this->sessionKeyFile, $this->key);
        }
        
        $this->nonce = $nonce;
    }

    public function encrypt(string $msg): string {
        return sodium_crypto_secretbox($msg, $this->nonce, base64_decode($this->key));
    }

    public function decrypt(string $msg): string {
        return sodium_crypto_secretbox_open($msg, $this->nonce, base64_decode($this->key));
    }
}