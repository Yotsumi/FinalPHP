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
        $user = $this->table->selectFromUsername($username);
        if (is_null($user)
            || HashMsg::compareHash($password, $user->getPassword()) === false) {
            return false;
        }
        $this->setSession($user);
        return true;
    }


    // method to control if user is logged
    public function isLoggedIn(): bool {
        if ($this->session->get(SESSION_USERNAME) === null
            || $this->session->get(SESSION_IP) != filter_var($_SERVER['REMOTE_ADDRESS'], FILTER_SANITIZE_IP)
            || $this->session->get(SESSION_USER_ID) === null
        ) {
            return false;
        }

        // is this needed each time?
        $user = $this->table->selectFromUsername($username);
        if ($user->getUsername() != $this->session->get(SESSION_USERNAME)
            || $user->getId() != $this->session->get(SESSION_USER_ID)) {
                return false;
        }

        // after TTL seconds reset session id
        if ($this->session->get(SESSION_START_DATE)->diff(new DateTime())->s > TTL) {
            $this->session->regen();
        }

        return true;
    }


    // store session data
    protected function setSession(User $user) : bool  {
        $this->session->set(SESSION_USER_ID, $user->getId());
        $this->session->set(SESSION_USERNAME, $user->getUsername());
        $this->session->set(SESSION_IP, filter_var($_SERVER['REMOTE_ADDRESS'], FILTER_SANITIZE_IP));
        $this->session->set(SESSION_START_DATE, date("YmdHis"));
        $this->session->regen();
    }

    // destroy session
    public function unlogUser() :void {
        $this->session->destroy();
    }
}