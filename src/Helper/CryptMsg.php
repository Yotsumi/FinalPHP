<?php
declare(strict_types=1);

namespace SimpleMVC\Helper;

class CryptMsg {

    protected static $sessionKeyFile = '/config/sessionKey.key';
    protected static $key = '';
    protected static $instance;
    
    // constructor is protected, so you must call the static instance() methos
    protected function __construct() {
        self::$sessionKeyFile = dirname(__DIR__ ,2) . self::$sessionKeyFile; 

        if (! file_exists(self::$sessionKeyFile)) {
            touch(self::$sessionKeyFile);
        }
        self::$key = file_get_contents(self::$sessionKeyFile);

        if (strlen(self::$key) === false) {
            self::$key = base64_encode(random_bytes(SODIUM_CRYPTO_SECRETBOX_KEYBYTES));
            file_put_contents(self::$$sessionKeyFile, self::$$key);
        }
        
        return $this;
    }

    // entry point for instance
    public static function instance() {       
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }


    public function encrypt(string $msg, string $nonce): string {
        return sodium_crypto_secretbox($msg, $nonce, base64_decode(self::$key));
    }


    public function decrypt(string $msg, string $nonce): string {
        return sodium_crypto_secretbox_open($msg, $nonce, base64_decode(self::$key));
    }
}