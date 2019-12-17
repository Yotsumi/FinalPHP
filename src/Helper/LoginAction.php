<?php
declare(strict_types=1);

namespace SimpleMVC\Helper;

use SimpleMVC\Model\Utente;
use SimpleMVC\Model\UtenteDb;
use SimpleMVC\Helper\HashMsg;

class LoginAction {

    const SESSION_USER_ID  = 'userid';
    const SESSION_USERNAME = 'username';
    const SESSION_START_DATE= 'started';
    const SESSION_IP = 'ip';

    const TTL = 3600; // session validity in seconds
    protected $session;
    protected $table;
    

    public function __construct(SessionHandle $session, UtenteDb $table) {
        $this->session = $session;
        $this->table = $table;
    }


    // method to check over db table and allow users
    public function loginUser(string $username, string $password) : bool {
        $user = $this->table->selectByKey([':username' => $username]);
        if (is_null($user) || is_null($user[0])
            || HashMsg::compareHash($password, $user[0]->getPassword()) === false) {
            return false;
        }
        $this->setSession($user[0]);
        return true;
    }


    // method to control if user is logged
    public function isLoggedIn(): bool {
        if ($this->session->get(self::SESSION_USERNAME) === null
            || $this->session->get(self::SESSION_IP) != filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)
            || $this->session->get(self::SESSION_USER_ID) === null
        ) {
            return false;
        }
        $uname = $this->session->get(self::SESSION_USERNAME);
        // is this needed each time?
        $user = $this->table->selectByKey([':username' => $uname]);
        if (is_null($user) || is_null($user[0])) {
            $this->unlogUser();
            http_response_code(401);
        }
        $user = $user[0];
        // $user = Utente::arrayConstruct($user[0]);
        if ($user->getUsername() != $this->session->get(self::SESSION_USERNAME)
            || $user->getHashUtente() != $this->session->get(self::SESSION_USER_ID)) {
                return false;
        }

        // after TTL seconds reset session id
    /*    if ($this->session->get(self::SESSION_START_DATE)->diff(new DateTime())->s > TTL) {
            $this->session->regen();
        }
*/
        return true;
    }


    // store session data
    protected function setSession(Utente $user) : void  {
        $this->session->set(self::SESSION_USER_ID, $user->getHashUtente());
        $this->session->set(self::SESSION_USERNAME, $user->getUsername());
        $this->session->set(self::SESSION_IP, $_SERVER['REMOTE_ADDR']);
        $this->session->set(self::SESSION_START_DATE, date("YmdHis"));
        $this->session->regen();
        var_dump($_SESSION);
        die();
    }

    // destroy session
    public function unlogUser() :void {
        $this->session->destroy();
    }
}