<?php
declare(strict_types=1);

namespace SimpleMVC\Helper;

class CryptMsg {

    protected static $sessionKeyFile = '/config/sessionKey.key';
    protected static $key;
    protected static $nonce;
    protected static $instance;
    
    
    // constructor is protected, so you must call the static instance() methos
    protected function __construct() {
        self::$sessionKeyFile = dirname(__DIR__ ,2) . self::$sessionKeyFile; 

        if (! file_exists(self::$sessionKeyFile)) {
            touch(self::$sessionKeyFile);
        }
        self::$key = file_get_contents(self::$sessionKeyFile);

        if (strlen(self::$key) < 1 || self::$key === false) {
            self::$key = random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES);
            file_put_contents(self::$sessionKeyFile, base64_encode(self::$key));
        } else {
            self::$key = base64_decode(self::$key);
        }

        // self::nonce();
        return $this;
    }

    // entry point for instance
    public static function instance() {       
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    // nonce getter (no setter)
    public static function nonce() {
        if (is_null(self::$nonce)) {

            if (! isset($_COOKIE['nonce'])) {
                $expires = 3600*3;
                self::$nonce = random_bytes(SODIUM_CRYPTO_SECRETBOX_NONCEBYTES);
                setcookie('nonce', self::$nonce, time() + $expires);  

            } else {
                self::$nonce = $_COOKIE['nonce'];
            }
        }
        
        return self::$nonce;
    }


    public function encrypt(string $msg, string $nonce): string {
        return sodium_crypto_secretbox($msg, $nonce, self::$key);
    }


    public function decrypt(string $msg, string $nonce): string {
        $value = sodium_crypto_secretbox_open($msg, $nonce, self::$key);
        // error throwing?
        if ($value === false){
            return '';
        }
        return $value;
    }
}