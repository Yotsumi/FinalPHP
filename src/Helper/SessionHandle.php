<?php
declare(strict_types=1);

namespace SimpleMVC\Helper;

use SimpleMVC\Helper\CryptMsg;

class SessionHandle {

    const SESSION_USER_ID  = 'userid';
    const SESSION_USERNAME = 'username';
    const SESSION_START_DATE= 'started';
    const SESSION_IP = 'ip';
    const IS_ADMIN   = 'isadmin';
    const TTL = 1500; // session validity in seconds

    protected static $instance;
    protected $crypt;

    protected function __construct(CryptMsg $crypt, string $nonce) {
        $this->nonce = $nonce;
        $this->crypt = $crypt;
    }

    public static function instance(CryptMsg $crypt, string $nonce) {
        if (is_null(self::$instance)) {
            self::$instance = new self($crypt, $nonce);
        }
        // start session (if needed)
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        return self::$instance;
    }

    public function regen(): bool {
        return session_regenerate_id();
    }


    public function set(string $key, string $value) {
        $value = $this->crypt->encrypt($value, $this->crypt->nonce());
        $_SESSION[$key] = $value;
    }

    public function get(string $key) :string{
        $value = $_SESSION[$key];
        return $this->crypt->decrypt($value, $this->crypt->nonce());
    }

    public function getLen() :int {
        return count($_SESSION);
    }

    public function unset(string $key) {
        unset($_SESSION[$key]);
    }


    public function destroy() {
        $_SESSION = [];
        session_destroy();
    }

    public function close() {
        session_write_close();
    }
}