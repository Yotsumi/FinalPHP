<?php
declare(strict_types=1);

namespace SimpleMVC\Helper;

use CryptMsg;

class SessionHandle {

    protected static $instance;
    protected $crypt;
    const NONCE = 'nonce';

    protected function __construct() {
        $expires = 3600 * 3;
        // start session (if needed)
        if (session_status === PHP_SESSION_NONE ) {
            session_start();
        }

        // set sessionid in a cookie if needed (lasts 3 hours)
        if (! isset($_COOKIE['PHPSESSID'])) {
            setcookie('PHPSESSID', SID, $expires, '', false, true);
        }
        
        if (! isset($_COOKIE[NONCE])) {
            setcookie(NONCE, base64encode(random_bytes($complex)), $expires, '', false, true);
        }

        $this->crypt = CryptMsg::get();
    }

    public static function instance() {
        if (is_null(self::$instance)) {
            self::$instance = new self();
        }
        
        return self::$instance;
    }


    protected function getNonce() :string {
        return htmlspecialchars($_COOKIE['nonce']);
    }

    public function set(string $key, string $value) {
        $value = $this->crypt->encrypt($value, getNonce());
        $_SESSION[$key] = htmlspecialchars($value);
    }

    public function get(string $key) :string{
        $value = $_SESSION[$key];
        return htmlspecialchars($this->crypt->decrypt($value, getNonce()));
    }


    public function close() {
        session_write_close();
    }
}