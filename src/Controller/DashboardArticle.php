<?php
declare(strict_types=1);

namespace SimpleMVC\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Model\ArticoloDb;
use SimpleMVC\Model\Articolo;
use SimpleMVC\Helper\LoginAction;
use SimpleMVC\Helper\RegexHelper;

class DashboardArticle implements ControllerInterface
{
    protected $plates;
    protected $table;
    protected $login;

    public function __construct(Engine $plates, ArticoloDb $table, LoginAction $login)
    {
        $this->plates = $plates;
        $this->table = $table;
        $this->login = $login;
    }

    protected function getView(ServerRequestInterface $request) :array {
        $regexString = RegexHelper::setUrl('dashboardarticle');
        $viewParam = '';
        if (preg_match($regexString, $request->getUri()->getPath(), $arres)){
            $viewParam = sprintf("%s", $arres[2]);
        }

        $args = [];
        $res  = [];
        $backPath = '/dashboard';

        // articles
        if (strlen($viewParam) == 0) {
            $res =  ['articleList', 'Articles'];
            $args = $this->table->selectAll();

        } elseif ($viewParam == 'addarticle') {
            $res =  ['addArticle', 'Add Article'];

        } else {
            $args = $this->table->selectByKey([':titolo' => str_replace('%20', ' ', $viewParam)]);
            $res =  ['modifyArticle', 'Edit Article'];
            if (! is_null($args) && count($args) > 0){
                $objArt = new Articolo();
                $objArt->setByArray($args[0]);
                $args = $objArt;
            }
            $backPath = '/dashboardarticle';
        } 

        array_push($res, $args, $backPath);
        return $res;
    }


    public function execute(ServerRequestInterface $request)
    {
        if ($this->login->isLoggedIn()) {
            list($view, $title, $args, $path) = $this->getView($request);
            echo $this->plates->render($view, [
                'title' => $title,
                'args'  => $args, 
                'user'  => $this->login->getUsername(),
                'btn'   => ['Back' => $path]
            ]);
        } else {
            $this->login->unlogUser(); // destroy session
            http_response_code(401);
            echo $this->plates->render('401');
        }
    }
}