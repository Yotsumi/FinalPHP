<?php
declare(strict_types=1);

namespace SimpleMVC\Controller;

use League\Plates\Engine;
use Psr\Http\Message\ServerRequestInterface;
use SimpleMVC\Model\Articolo;

class Article implements ControllerInterface
{
    protected $plates;

    public function __construct(Engine $plates)
    {
        $this->plates = $plates;
    }

    public function execute(ServerRequestInterface $request)
    {
        $regexString = '/^(\/article)\/([\w-]+)$/';
        preg_match($regexString, $_SERVER['PATH_INFO'], $arres);
        $articleTitle = str_replace("-", " ", $arres[2]);
        
        //db call for take article

        $article = new Articolo(2, $articleTitle, "Contenuto", "Autore", "11/10/19");

        echo $this->plates->render('article', [
            'id' => $article->getId(),
            'title' => $article->getTitolo(),
            'autore' => $article->getAutore(),
            'contenuto' => $article->getContenuto(),
            'data' => $article->getData()
            ]);
    }
}