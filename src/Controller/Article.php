<?php
declare(strict_types=1);

namespace SimpleMVC\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Model\Articolo;
use SimpleMVC\Model\ArticoloClient;
use SimpleMVC\Helper\RegexHelper;

class Article implements ControllerInterface
{
    protected $plates;
    protected $table;

    public function __construct(Engine $plates, ArticoloClient $table)
    {
        $this->plates = $plates;
        $this->table = $table;
    }

    public function execute(ServerRequestInterface $request)
    {
        preg_match(RegexHelper::setUrl('article'), $_SERVER['PATH_INFO'], $arres);
        $articleTitle = str_replace("-", " ", $arres[2]);
        
        //TODO db call for take article
        $article = $this->table->selectByKey([':titolo' => $articleTitle]);
        if ($article === null || count($article) == 0){
            echo $this->plates->render('article', ['articleNotFound' => true]);
            die();
        }
        $objArt = new Articolo();
        $article = $objArt->setByArray($article[0]);

        echo $this->plates->render('article', [
            'id' => $objArt->getId(),
            'title' => $objArt->getTitolo(),
            'autore' => $objArt->getAutore(),
            'contenuto' => $objArt->getContenuto(),
            'data' => $objArt->getData(),

            'articleNotFound' => false
            ]);
    }
}