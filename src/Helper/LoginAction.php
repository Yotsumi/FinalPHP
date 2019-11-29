<?php
declare(strict_types=1);

namespace SimpleMVC\Helper;

use SimpleMVC\Model\User;
use SimpleMVC\Model\UserDb;
use SimpleMVC\Helper\HashMsg;

class LoginAction {

    protected $session;
    protected $table;
    const SESSION_USER_ID  = 'userid';
    const SESSION_USERNAME = 'username';
    const SESSION_IP = 'ip';

    public function __construct(SessionHandle $session, UserDb $table) {
        $this->session = $session;
        $this->table = $table;
    }

    // basic compare from db
    protected function setSession(User $user) : bool  {
        $this->session->set(SESSION_USER_ID, $user->getId());
        $this->session->set(SESSION_USERNAME, $user->getUsername());
        $this->session->set(SESSION_IP, filter_var($_SERVER['REMOTE_ADDRESS'], FILTER_SANITIZE_IP));
        $this->session->regen();
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
            || $this->session->get(SESSION_USER_ID) === null) {
                return false;
        }

        $user = $this->table->selectFromUsername($username);
        if ($user->getUsername() != $this->session->get(SESSION_USERNAME)
            || $user->getId() != $this->session->get(SESSION_USER_ID)) {
                return false;
        }
        return true;
    }

}