<?php
declare(strict_types=1);

namespace SimpleMVC\Controller;


use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Model\ArticoloDb;
use SimpleMVC\Model\Articolo;
use SimpleMVC\Helper\RegexHelper;

class DashboardArticle implements ControllerInterface
{
    protected $plates;
    protected $table;


    public function __construct(Engine $plates, ArticoloDb $table)
    {
        $this->plates = $plates;
        $this->table = $table;
    }

    protected function getView(ServerRequestInterface $request) :array {
        $regexString = RegexHelper::setUrl('dashboardarticle');
        $viewParam = '';
        if (preg_match($regexString, $request->getUri()->getPath(), $arres)){
            $viewParam = sprintf("%s", $arres[2]);
        }

        $args;
        $res = [];

        // articles
        if (strlen($viewParam) < 1) {
            $res =  ['articleList', 'Articles'];
            $args = $this->table->selectAll();

        } elseif ($viewParam == 'addarticle') {
            $res =  ['addArticle', 'Add Article'];

        } elseif ($viewParam == 'listarticle') {
            $res =  ['articleList', 'Articles'];

        } else {
            $args = $this->table->selectByKey([':id' => $viewParam]);
            $res =  ['modifyArticle', 'Edit Article'];
        } 



        if (! is_null($args) && count($args) > 0){
            for ($i = 0; $i < count($args); $i++) {
                $args[$i] = new Articolo($args[$i]);
            }
        }

        array_push($res, $args);
        return $res;
    }


    public function execute(ServerRequestInterface $request)
    {
        $view = $this->getView($request);
        var_dump($view);
        //die();
        echo $this->plates->render($view[0], [
            'title' => $view[1],
            'args' => $view[2]
        ]);
    }
}