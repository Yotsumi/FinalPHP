<?php
declare(strict_types=1);

namespace SimpleMVC\Helper;

use SimpleMVC\Model\Utente;
use SimpleMVC\Model\UtenteDb;
use SimpleMVC\Helper\HashMsg;

class LoginAction {

    protected $session;
    protected $table;
    

    public function __construct(SessionHandle $session, UtenteDb $table) {
        $this->session = $session;
        $this->table = $table;
    }


    // method to check over db table and allow users
    public function loginUser(string $username, string $password) : bool {
        $user = $this->table->selectByKey([':username' => $username]);
        if (is_null($user) || count($user) < 1
            || HashMsg::compareHash($password, $user[0]->getPassword()) === false
            ) {
            return false;
        }
        $this->setSession($user[0]);
        return true;
    }


    // method to control if user is logged
    public function isLoggedIn(): bool {
        if ($this->session->getLen() < 1) {
            return false;
        }

        if ($this->session->get(SessionHandle::SESSION_USERNAME) === null
            || $this->session->get(SessionHandle::SESSION_IP) != filter_var($_SERVER['REMOTE_ADDR'], FILTER_VALIDATE_IP)
            || $this->session->get(SessionHandle::SESSION_USER_ID) === null
        ) {
            return false;
        }
        $uname = $this->session->get(SessionHandle::SESSION_USERNAME);
        // is this needed each time?
        $user = $this->table->selectByKey([':username' => $uname]);
        if (is_null($user) || is_null($user[0])) {
            return false;
        }
        $user = $user[0];
        // $user = Utente::arrayConstruct($user[0]);
        if ($user->getUsername() != $this->session->get(SessionHandle::SESSION_USERNAME)
            || $user->getHashUtente() != $this->session->get(SessionHandle::SESSION_USER_ID)) {
                return false;
        }

        // after TTL seconds reset session id
        $datetime1 = strtotime($this->session->get(SessionHandle::SESSION_START_DATE));//start time
        $datetime2 = strtotime(date('Y-m-d h:i:s'));//end time
        
        if ($datetime2 - $datetime1 > SessionHandle::TTL) {
            $this->session->regen();
            $this->session->set(SessionHandle::SESSION_START_DATE, date('Y-m-d h:i:s'));
        }
        return true;
    }


    // store session data
    protected function setSession(Utente $user) : void  {
        $this->session->set(SessionHandle::SESSION_USER_ID, $user->getHashUtente());
        $this->session->set(SessionHandle::SESSION_USERNAME, $user->getUsername());
        $this->session->set(SessionHandle::SESSION_IP, $_SERVER['REMOTE_ADDR']);
        $this->session->set(SessionHandle::SESSION_START_DATE, date('Y-m-d h:i:s'));
        $this->session->set(SessionHandle::IS_ADMIN, $user->getAbilitato() == true? '1' : '0');
        $this->session->regen();
    }

    // destroy session
    public function unlogUser() :void {
        $this->session->destroy();
    }

    // get username
    public function getUsername() :string {
        return $this->session->get(SessionHandle::SESSION_USERNAME);
    }

    public function getIsAdmin() :string {
        return $this->session->get(SessionHandle::IS_ADMIN);
    }
}