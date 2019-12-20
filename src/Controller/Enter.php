<?php
declare(strict_types=1);

namespace SimpleMVC\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Helper\SessionHandle;
use SimpleMVC\Helper\LoginAction;
use SimpleMVC\Helper\PostDataHelper;
use SimpleMVC\Helper\CleanData;

use SimpleMVC\Helper\CryptMsg;

class Enter implements ControllerInterface
{
    protected $plates;
    protected $login;

    public function __construct(Engine $plates, LoginAction $login)
    {
        $this->login = $login;
        $this->plates = $plates;
    }

    public function execute(ServerRequestInterface $request)
    {
        $post = $request->getParsedBody();
        PostDataHelper::checkPostData($post);
        $post = CleanData::cleanArray($post);

        // exec login logics
        $username = $post['user'];
        $password = $post['pwd'];

        if ($this->login->loginUser($username, $password)) {
            header('Location: '. "/dashboard"); 
        } else {
            http_response_code(401);
            echo $this->plates->render('401');
        }
    }
}