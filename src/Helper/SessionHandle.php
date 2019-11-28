<?php
declare(strict_types=1);

namespace SimpleMVC\Helper;

use SimpleMVC\Helper\CryptMsg;

class SessionHandle {

    protected static $instance;
    protected $crypt;

    protected function __construct(string $nonce) {
        $expires = 3600 * 3;
        $secure = false;
        $httponly = true;
        $nonceBytes = 4;

        // start session (if needed)
        if (session_status() === PHP_SESSION_NONE ) {
            session_start();
        }
       
        $this->nonce = $nonce;
        $this->crypt = CryptMsg::instance();
    }

    public static function instance(string $nonce) {
        if (is_null(self::$instance)) {
            self::$instance = new self($nonce);
        }
        
        return self::$instance;
    }


    public function set(string $key, string $value) {
        $value = $this->crypt->encrypt($value, $this->crypt->nonce());
        $_SESSION[$key] = htmlspecialchars($value);
    }

    public function get(string $key) :string{
        $value = $_SESSION[$key];
        return htmlspecialchars($this->crypt->decrypt($value, $this->crypt->nonce()));
    }


    public function close() {
        session_write_close();
    }
}